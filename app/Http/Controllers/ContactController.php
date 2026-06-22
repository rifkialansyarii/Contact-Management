<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
       try {    
            $contact = Contact::select(['id', 'name', 'phone_number', 'email'])->get();

            $contactCollection = new ContactCollection($contact);
            return $contactCollection->additional([
                'success' => true,
                'code' => 200,
                'message' => 'Data retrieved successfully',
            ]);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    public function show(Contact $contact){
         try {    
            $contact = Contact::select(['id', 'name', 'phone_number', 'email'])->first();

            $contactResource = new ContactResource($contact);
            return $contactResource->additional([
                'success' => true,
                'code' => 200,
                'message' => 'Data retrieved successfully',
            ]);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    public function store(StoreContactRequest $request ){
        try {    
            $contact = Contact::create($request->validated());

            $contactCollection = new ContactResource($contact);
            return $contactCollection->additional([
                'success' => true,
                'code' => 201,
                'message' => 'Data created successfully',
            ]);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    public function update(UpdateContactRequest $request, Contact $contact){
        try {    
            $contact->update($request->validated());

            $contactCollection = new ContactResource($contact->refresh());
            return $contactCollection->additional([
                'success' => true,
                'code' => 200,
                'message' => 'Data updated successfully',
            ]);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    public function destroy(Contact $contact){
        try {    
            $contact->delete();

            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Data deleted successfully',
            ]);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }
}
