<?php
class Candidate
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCandidates($page, $perPage, $sortBy, $searchKeyword = null, $isLocation = null)
    {
        // Calculate the offset based on the page number and records per page
        $offset = ($page - 1) * $perPage;

        // Prepare the SQL query with LIMIT, OFFSET, and ORDER BY
        $query = "SELECT * FROM jobseekers";

        // Add search filter if search keyword is provided
        if ($searchKeyword !== null && $isLocation == 0) {
            $query .= " WHERE (username LIKE :searchKeyword)";
        }

        if ($searchKeyword !== null && $isLocation == 1) {
            $query .= " WHERE (address LIKE :searchKeyword)";
        }

        if ($sortBy == "date_joined") {
            $query .= " ORDER BY created_at DESC";
        }

        if ($sortBy == "profile_completion") {
            $query .= " ORDER BY is_complete DESC";
        }
        // Add LIMIT and OFFSET to the query
        $query .= " LIMIT :perPage OFFSET :offset";

        // Bind parameters
        $this->db->query($query);
        $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if ($searchKeyword !== null) {
            $searchKeyword = '%' . $searchKeyword . '%';
            $this->db->bind(':searchKeyword', $searchKeyword);
        }

        // Execute the query
        $results = $this->db->resultset();

        return $results;
    }
}
