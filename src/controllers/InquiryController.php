<?php
namespace Controllers;

use Core\Controller;
use Models\InquiryModel;

class InquiryController extends Controller
{
    public function create()
    {
        $input = $this->getInput();

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

        try {
            $inquiryModel = new InquiryModel();
            $result = $inquiryModel->updateInquiry($id, $input);

            if ($result) {
                return $this->jsonResponse(['message' => 'Inquiry updated successfully']);
            } else {
                return $this->jsonResponse(['message' => 'Failed to update inquiry'], 400);
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(['message' => 'An error occurred while updating the inquiry.'], 500);
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

    protected function getInput()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        return filter_var_array($input, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    protected function jsonResponse($data, $statusCode = 200)
    {
        \Helpers\ResponseHelper::jsonResponse($data, $statusCode);
    }
}
