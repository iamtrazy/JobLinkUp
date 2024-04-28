<?php
class Algorithm
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function match_keywords($id)
    {
        $this->db->query("SELECT DISTINCT j.id, j.topic, j.created_at, j.location
        FROM jobs j
        JOIN (
            SELECT id AS jobseeker_id, TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(keywords, ',', n), ',', -1)) AS keyword
            FROM jobseekers
            CROSS JOIN (SELECT 1 + units.i + tens.i * 10 AS n
                        FROM (SELECT 0 AS i UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS units
                        CROSS JOIN (SELECT 0 AS i UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS tens
                        ORDER BY n
                       ) AS numbers
            WHERE n <= 1 + LENGTH(keywords) - LENGTH(REPLACE(keywords, ',', ''))
        ) js ON j.keywords LIKE CONCAT('%', js.keyword, '%')
        WHERE js.jobseeker_id = :id AND j.expire_in >= CURDATE() AND  j.is_deleted = 0
        LIMIT 10;
    ");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }


    public function match_location($id)
    {
        $this->db->query("SELECT address from jobseekers where id = :id");
        $this->db->bind(':id', $id);
        $address = $this->db->single()->address;

        $address = strtolower($address);

        // Split the address into individual words
        $words = preg_split('/\s+|[,.-]\s*/', $address, -1, PREG_SPLIT_NO_EMPTY);

        // Remove words containing numbers
        $words = array_filter($words, function ($word) {
            return !preg_match('/\d/', $word);
        });

        $sql = "SELECT id, topic, created_at, location
        FROM jobs
        WHERE ";
        foreach ($words as $index => $word) {
            if ($index > 0) {
                $sql .= "OR ";
            }
            $sql .= "LOWER(location) LIKE '%" . $word . "%' ";
        }
        $sql .= "AND jobs.expire_in >= CURDATE() AND  jobs.is_deleted = 0 LIMIT 10;";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}
