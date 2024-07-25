<?php

namespace Models;

use Core\Model;
use PDO;
use PDOException;

class InquiryModel extends Model
{
    public function createInquiry($data)
    {
        // Check for duplicate record
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM inquiry WHERE id_type = :id_type AND id_number = :id_number AND requested_report = :requested_report AND report_date = :report_date AND subject_type = :subject_type AND scoring_tag = :scoring_tag AND created_at = :created_at AND batch_type = :batch_type');
        $stmt->execute([
            'id_type' => $data['id_type'],
            'id_number' => $data['id_number'],
            'requested_report' => $data['requested_report'],
            'report_date' => $data['report_date'],
            'subject_type' => $data['subject_type'],
            'scoring_tag' => $data['scoring_tag'],
            'created_at' => $data['created_at'],
            'batch_type' => $data['batch_type']
        ]);

        if ($stmt->fetchColumn() > 0) {
            return ['error' => 'Record already exists'];
        }

        try {
            $stmt = $this->db->prepare('INSERT INTO inquiry (id_type, id_number, requested_report, report_date, subject_type, scoring_tag, created_at, batch_type, approval) VALUES (:id_type, :id_number, :requested_report, :report_date, :subject_type, :scoring_tag, :created_at, :batch_type, :approval)');
            $data['approval'] = 0; // Set default approval status to 0
            $stmt->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getInquiryById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM inquiry WHERE no = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllInquiries()
    {
        $stmt = $this->db->query('SELECT * FROM inquiry');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApprovedInquiries()
    {
        $stmt = $this->db->query('SELECT * FROM inquiry WHERE approval = 1');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateInquiry($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fields = implode(', ', $fields);

        $stmt = $this->db->prepare("UPDATE inquiry SET $fields WHERE no = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function approveInquiry($id)
    {
        $stmt = $this->db->prepare('UPDATE inquiry SET approval = 1 WHERE no = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function deleteInquiry($id)
    {
        // Check if the record exists before deletion
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM inquiry WHERE no = :id');
        $stmt->execute(['id' => $id]);
        if ($stmt->fetchColumn() == 0) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM inquiry WHERE no = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function searchInquiries($idNumber, $reportDate)
    {
        $sql = 'SELECT * FROM inquiry WHERE 1=1';
        $params = [];

        if ($idNumber) {
            $sql .= ' AND id_number = :id_number';
            $params['id_number'] = $idNumber;
        }

        if ($reportDate) {
            $sql .= ' AND report_date = :report_date';
            $params['report_date'] = $reportDate;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnapprovedInquiries()
    {
        $stmt = $this->db->query('SELECT * FROM inquiry WHERE approval = 0');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
