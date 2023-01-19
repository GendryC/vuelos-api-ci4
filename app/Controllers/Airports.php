<?php

namespace App\Controllers;

use App\Models\AirportModel;
use CodeIgniter\RESTful\ResourceController;

class Airports extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $model = new AirportModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $model = new AirportModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data not found');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new ()
    {
        //

    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
        $rules = [
            'name' => ['rules' => 'required|max_length[255]'],
            'city' => ['rules' => 'required|max_length[255]'],
            'country' => ['rules' => 'required|max_length[255]'],
        ];


        if ($this->validate($rules)) {
            $model = new AirportModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'city' => $this->request->getVar('city'),
                'country' => $this->request->getVar('country'),
            ];
            $model->insert($data);

            return $this->respond(['message' => 'Successfull'], 200);
        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);

        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
        $model = new AirportModel();
        $data1 = $model->where('id', $id)->first();
        if ($data1) {
            $data = [
                'name' => $this->request->getVar('name'),
                'city' => $this->request->getVar('city'),
                'country' => $this->request->getVar('country'),
            ];
            $model->update($id, $data);
            return $this->respond(['message' => 'Successfull'], 200);
        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid id'
            ];
            return $this->fail($response, 409);

        }
        
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        $model = new AirportModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Deleted!!'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Not found');
        }
    }
}