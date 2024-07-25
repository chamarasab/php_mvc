<?php

namespace Controllers;

use Core\Controller;
use Models\InquiryModel;

class InquiryController extends Controller
{
    public function create()
    {
        $input = $this->getInput();

        // Validate input
        $errors = $this->validateInput($input);
        if (!empty($errors)) {
            return $this->jsonResponse(['errors' => $errors], 400);
        }

        try {
            $inquiryModel = new InquiryModel();
            $result = $inquiryModel->createInquiry($input);

            if (isset($result['error'])) {
                return $this->jsonResponse(['message' => $result['error']], 400);
            }

            return $this->jsonResponse(['message' => 'Inquiry created successfully', 'inquiry_id' => $result], 201);
        } catch (\Exception $e) {
            error_log($e->getMessage()); // Log the exception message
            return $this->jsonResponse(['message' => 'An error occurred while creating the inquiry.', 'error' => $e->getMessage()], 500);
        }
    }

    private function validateInput($input)
    {
        $errors = [];

        if (empty($input['id_type'])) {
            $errors[] = 'ID type is required.';
        }
        if (empty($input['id_number'])) {
            $errors[] = 'ID number is required.';
        }
        if (empty($input['requested_report'])) {
            $errors[] = 'Requested report is required.';
        }
        if (empty($input['report_date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $input['report_date'])) {
            $errors[] = 'Valid report date is required.';
        }
        if (empty($input['subject_type'])) {
            $errors[] = 'Subject type is required.';
        }
        if (empty($input['scoring_tag'])) {
            $errors[] = 'Scoring tag is required.';
        }
        if (empty($input['created_at']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $input['created_at'])) {
            $errors[] = 'Valid creation date is required.';
        }
        if (empty($input['batch_type'])) {
            $errors[] = 'Batch type is required.';
        }

        return $errors;
    }

    public function read($id)
    {
        $inquiryModel = new InquiryModel();
        $inquiry = $inquiryModel->getInquiryById($id);

        if ($inquiry) {
            return $this->jsonResponse($inquiry);
        } else {
            return $this->jsonResponse(['message' => 'Inquiry not found'], 404);
        }
    }

    public function readAll()
    {
        $inquiryModel = new InquiryModel();
        $inquiries = $inquiryModel->getAllInquiries();
        return $this->jsonResponse($inquiries);
    }

    public function update($id)
    {
        $input = $this->getInput();

        // Check if the inquiry exists
        $inquiryModel = new InquiryModel();
        $existingInquiry = $inquiryModel->getInquiryById($id);
        if (!$existingInquiry) {
            return $this->jsonResponse(['message' => 'Inquiry not found'], 404);
        }

        // Check if the input values are the same as the existing values
        $isSame = true;
        foreach ($input as $key => $value) {
            if (isset($existingInquiry[$key]) && $existingInquiry[$key] != $value) {
                $isSame = false;
                break;
            }
        }

        if ($isSame) {
            return $this->jsonResponse(['message' => 'No need to update, same values provided']);
        }

        // If there are changes, proceed with the update
        try {
            $result = $inquiryModel->updateInquiry($id, $input);
            if ($result) {
                return $this->jsonResponse(['message' => 'Inquiry updated successfully']);
            } else {
                return $this->jsonResponse(['message' => 'Failed to update inquiry'], 400);
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(['message' => 'An error occurred while updating the inquiry.', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $inquiryModel = new InquiryModel();
        $result = $inquiryModel->deleteInquiry($id);

        if ($result) {
            return $this->jsonResponse(['message' => 'Inquiry deleted successfully']);
        } else {
            return $this->jsonResponse(['message' => 'Inquiry not found'], 404);
        }
    }

    public function search()
    {
        $input = $this->getInput();
        $idNumber = $input['id_number'] ?? null;
        $reportDate = $input['report_date'] ?? null;

        $inquiryModel = new InquiryModel();
        $results = $inquiryModel->searchInquiries($idNumber, $reportDate);

        return $this->jsonResponse($results);
    }

    public function approve($id)
    {
        $inquiryModel = new InquiryModel();
        $inquiry = $inquiryModel->getInquiryById($id);

        if (!$inquiry) {
            return $this->jsonResponse(['message' => 'Inquiry not found'], 404);
        }

        if ($inquiry['approval'] == 1) {
            return $this->jsonResponse(['message' => 'Inquiry already approved']);
        }

        $result = $inquiryModel->approveInquiry($id);
        if ($result) {
            return $this->jsonResponse(['message' => 'Inquiry approved successfully']);
        } else {
            return $this->jsonResponse(['message' => 'Failed to approve inquiry'], 400);
        }
    }

    public function getApprovedInquiries()
    {
        $inquiryModel = new InquiryModel();
        $inquiries = $inquiryModel->getApprovedInquiries();
        return $this->jsonResponse($inquiries);
    }

    protected function getInput()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        return filter_var_array($input, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    protected function jsonResponse($data, $statusCode = 200)
    {
        \Helpers\ResponseHelper::jsonResponse($data, $statusCode);
    }

    public function getUnapprovedInquiries()
    {
        $inquiryModel = new InquiryModel();
        $inquiries = $inquiryModel->getUnapprovedInquiries();
        return $this->jsonResponse($inquiries);
    }
}
