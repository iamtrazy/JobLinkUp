const express = require('express');
const axios = require('axios');
const fs = require('fs');
const FormData = require('form-data');
const path = require('path');
const { v4: uuidv4 } = require('uuid');

const app = express();
const PORT = 3000;

app.get('*', async (req, res) => {
  const originalPath = req.path;
  const imageUrl = `https://i.ikman-st.com${originalPath}`;

  const imagePath = path.join(__dirname, 'temp.jpg');
  try {
    const downloadedImagePath = await downloadImage(imageUrl, imagePath);
    const responseHtml = await uploadImage(downloadedImagePath);
    const base64Image = extractBase64Image(responseHtml);

    res.send(`
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Processed Image</title>
      </head>
      <body>
        <h1>Processed Image</h1>
        <img src="data:image/jpeg;base64,${base64Image}" alt="Processed Image">
      </body>
      </html>
    `);

    // Cleanup temporary files
    fs.unlinkSync(downloadedImagePath);
  } catch (error) {
    console.error('Error:', error);
    res.status(500).send('Error processing the image');
  }
});

const downloadImage = async (url, outputPath) => {
  const writer = fs.createWriteStream(outputPath);

  const response = await axios({
    url,
    method: 'GET',
    responseType: 'stream',
  });

  response.data.pipe(writer);

  return new Promise((resolve, reject) => {
    writer.on('finish', () => resolve(outputPath));
    writer.on('error', reject);
  });
};

const uploadImage = async (imagePath) => {
  const form = new FormData();
  form.append('file', fs.createReadStream(imagePath), path.basename(imagePath));

  const headers = {
    ...form.getHeaders(),
    'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0',
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
    'Accept-Language': 'en-US,en;q=0.5',
    'Sec-GPC': '1',
    'Upgrade-Insecure-Requests': '1',
    'Sec-Fetch-Dest': 'document',
    'Sec-Fetch-Mode': 'navigate',
    'Sec-Fetch-Site': 'same-origin',
    'Sec-Fetch-User': '?1',
    'Priority': 'u=1',
  };

  const response = await axios.post('https://watermarkcleaner.com/', form, { headers });
  return response.data;
};

const extractBase64Image = (html) => {
  const base64Marker = 'data:image/jpeg;base64,';
  const startIndex = html.indexOf(base64Marker) + base64Marker.length;
  const endIndex = html.indexOf('"', startIndex);  // Adjust the endIndex to stop at the next double-quote
  return html.substring(startIndex, endIndex).trim();
};

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
