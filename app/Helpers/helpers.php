<?php
/**
     * Send a JSON response.
     *
     * @param int $statusCode
     * @param string $message
     * @param mixed $data
     * @param array $pagination
     * @return \Illuminate\Http\JsonResponse
     */
if (!function_exists('sendResponse'))
{
    function sendResponse($message, $data = null, $pagination = [], $statusCode)
    {
        $response = [
            'status' => $statusCode,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination
        ];

        return response()->json($response);
    }
}