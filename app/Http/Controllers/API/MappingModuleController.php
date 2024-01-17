<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\City;
use App\Models\Company;
use App\Models\State;
use App\Models\Country;
use App\Models\CompanyData;
use App\Models\Industry;
use App\Models\IndustryData;
use App\Models\JobTitle;
use App\Models\JobTitleData;
use App\Models\UnassignedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


class MappingModuleController extends Controller
{
    //Assign Cities Data
    public function assignedCitiesData(Request $request)
    {

        $assignDataIds = $request->input('assign_data_id');

        $assignData = $request->input('assign_data');

        $city_id = $request->input('city_id');

        $state_id = 1;

        $country_id = 1;

        if (isset($assignData) && !empty($assignData)) {
            foreach ($assignData as $row) {
                City::create([
                    'name' => $row,
                    'parent_id' => $city_id,
                    'state_id' => $state_id
                ]);
            }

            foreach ($assignDataIds as $row) {

                $record = UnassignedData::find($row);

                if ($record) {
                    $record->delete();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'City Stored Successfully.'
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Incorrect Data.'
                ]
            );
        }
    }

    //Assign State Data.
    public function assignedStatesData(Request $request)
    {
        $assignDataIds = $request->input('assign_data_id');

        $assignData = $request->input('assign_data');

        $state_id = $request->input('state_id');

        $country_id = 1;

        if (isset($assignData) && !empty($assignData)) {
            foreach ($assignData as $row) {
                State::create([
                    'name' => $row,
                    'parent_id' => $state_id,
                    'country_id' => $country_id
                ]);
            }

            foreach ($assignDataIds as $row) {

                $record = UnassignedData::find($row);

                if ($record) {
                    $record->delete();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'State Stored Successfully.'
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Incorrect Data.'
                ]
            );
        }
    }

    //Assign Country Data.
    public function assignedCountriesData(Request $request)
    {
        $assignDataIds = $request->input('assign_data_id');

        $assignData = $request->input('assign_data');

        $country_id = $request->input('country_id');

        if (isset($assignData) && !empty($assignData)) {
            foreach ($assignData as $row) {
                Country::create([
                    'name' => $row,
                    'parent_id' => $country_id
                ]);
            }

            foreach ($assignDataIds as $row) {

                $record = UnassignedData::find($row);

                if ($record) {
                    $record->delete();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Country Stored Successfully.'
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Incorrect Data.'
                ]
            );
        }
    }

    //Assign Industry Data.
    public function assignedIndustriesData(Request $request)
    {
        $assignDataIds = $request->input('assign_data_id');

        $assignData = $request->input('assign_data');

        $industry_id = $request->input('industry_id');

        if (isset($assignData) && !empty($assignData)) {
            foreach ($assignData as $row) {
                Industry::create([
                    'name' => $row,
                    'parent_id' => $industry_id
                ]);
            }

            foreach ($assignDataIds as $row) {

                $record = UnassignedData::find($row);

                if ($record) {
                    $record->delete();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Industries Stored Successfully.'
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Incorrect Data.'
                ]
            );
        }
    }


    //Assign Company Data.
    public function assignedCompaniesData(Request $request)
    {
        $assignDataIds = $request->input('assign_data_id');

        $assignData = $request->input('assign_data');

        $company_id = $request->input('company_id');

        if (isset($assignData) && !empty($assignData)) {
            foreach ($assignData as $row) {
                Company::create([
                    'name' => $row,
                    'parent_id' => $company_id
                ]);
            }

            foreach ($assignDataIds as $row) {

                $record = UnassignedData::find($row);

                if ($record) {
                    $record->delete();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Companies Stored Successfully.'
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Incorrect Data.'
                ]
            );
        }
    }


    //Assign Job Title Data.
    public function assignedJobTitlesData(Request $request)
    {
        $assignDataIds = $request->input('assign_data_id');

        $assignData = $request->input('assign_data');

        $job_title_id = $request->input('job_title_id');

        if (isset($assignData) && !empty($assignData)) {
            foreach ($assignData as $row) {
                JobTitle::create([
                    'name' => $row,
                    'parent_id' => $job_title_id
                ]);
            }

            foreach ($assignDataIds as $row) {

                $record = UnassignedData::find($row);

                if ($record) {
                    $record->delete();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Job-Title Stored Successfully.'
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Incorrect Data.'
                ]
            );
        }
    }

    public function unassignedData(Request $request)
    {
        $data_module_type = $request->input('data_module_type');

        if (isset($data_module_type) && !empty($data_module_type)) {

            if ($data_module_type === 'industry') {

                $industryData = UnassignedData::where('type', 'industry')->get()->toArray();

                return response()->json([
                    'status' => 200,
                    'message' => 'Unassigned Industry Data',
                    'data' => $industryData
                ]);
            } else if ($data_module_type === 'job_title') {

                $JobTitleData =  UnassignedData::where('type', 'job_title')->get()->toArray();

                return response()->json([
                    'status' => 200,
                    'message' => 'Unassigned Job Title Data',
                    'data' => $JobTitleData
                ]);
            } else if ($data_module_type === "company") {
                $companyData =  UnassignedData::where('type', 'company')->get()->toArray();

                return response()->json([
                    'status' => 200,
                    'message' => 'Unassigned Company Data',
                    'data' => $companyData
                ]);
            } else if ($data_module_type === "country") {
                $countryData =  UnassignedData::where('type', 'country')->get()->toArray();

                return response()->json([
                    'status' => 200,
                    'message' => 'Unassigned Country Data',
                    'data' => $countryData
                ]);
            } else if ($data_module_type === "state") {
                $stateData =  UnassignedData::where('type', 'state')->get()->toArray();

                return response()->json([
                    'status' => 200,
                    'message' => 'Unassigned State Data',
                    'data' => $stateData
                ]);
            } else if ($data_module_type === "city") {
                $cityData =  UnassignedData::where('type', 'city')->get()->toArray();

                return response()->json([
                    'status' => 200,
                    'message' => 'Unassigned City Data',
                    'data' => $cityData
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Incorret Parameter.'
                ]);
            }
        }
    }

    //Counting Mapping data
    public function countMappingData()
    {
        $cities = City::all();
        $cityCount = $cities->count();

        $states = State::all();
        $stateCount =  $states->count();

        $countries = Country::all();
        $countryCount =  $countries->count();

        $industries = Industry::all();
        $industryCount =  $industries->count();

        $jobtitles = JobTitle::all();
        $jobTitleCount =   $jobtitles->count();

        $companies = Company::all();
        $companyCount =   $companies->count();

        if ($cityCount && $stateCount && $countryCount && $industryCount && $companyCount && $jobTitleCount) {
            return response()->json([
                'status' => 200,
                'message' => 'All Mapping Data Analytics',
                'cityCount' => $cityCount,
                'stateCount' => $stateCount,
                'countryCount' => $countryCount,
                'industryCount' => $industryCount,
                'companyCount' => $companyCount,
                'jobTitleCount' => $jobTitleCount
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }

    //Cities - CRUD
    public function cities()
    {
        $cities = City::all();

        if ($cities) {
            return response()->json([
                'status' => 200,
                'message' => 'All Cities',
                'data' => $cities
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }


    //Show City Details
    public function show_cities($id)
    {
        $city = City::where('id', $id)->first();

        if ($city) {

            return response()->json([
                'status' => 200,
                'message' => 'City Details',
                'data' => $city
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    // Save Cities
    public function save_cities(Request $request)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $city = new City();

        // $city->uuid = Uuid::uuid4()->toString();
        $city->name = $request->name;
        $city->parent_id = 1;
        $city->state_id = 1;
        $success = $city->save();

        if ($success) {
            return response()->json([
                'status' => 200,
                'message' => 'City Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Something Went Wrong. Please try again later.'
            ]);
        }
    }

    // Update Cities
    public function update_cities(Request $request, $id)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $city = City::where('id', $id)->first();

            if ($city) {

                // $city->uuid = Uuid::uuid4()->toString();
                $city->name = $request->name;
                $city->parent_id = 1;
                $city->state_id = 1;
                $success = $city->update();

                if ($success) {

                    return response()->json([
                        'status' => 200,
                        'message' => 'City Updated Successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something Went Wrong. Please try again later.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not Found.'
                ]);
            }
        }
    }

    //Delete City
    public function destroy_cities(Request $request, $id)
    {
        //Delete
        $city = City::find($id);

        if ($city) {
            $deleted = $city->delete();

            return response()->json([
                'status' => 200,
                'message' => 'City Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not Found.'
            ]);
        }
    }


    //States - CRUD
    public function states()
    {
        $states = State::all();

        if ($states) {
            return response()->json([
                'status' => 200,
                'message' => 'All States',
                'data' => $states
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }

    //Show State Details
    public function show_states($id)
    {
        $state = State::where('id', $id)->first();

        if ($state) {

            return response()->json([
                'status' => 200,
                'message' => 'State Details',
                'data' => $state
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    // Save States
    public function save_states(Request $request)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $state = new State();

        // $state->uuid = Uuid::uuid4()->toString();
        $state->name = $request->name;
        $state->parent_id = 1;
        $state->country_id = 1;
        $success = $state->save();

        if ($success) {
            return response()->json([
                'status' => 200,
                'message' => 'State Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Something Went Wrong. Please try again later.'
            ]);
        }
    }

    // Update States
    public function update_states(Request $request, $id)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $state = State::where('id', $id)->first();

            if ($state) {

                // $city->uuid = Uuid::uuid4()->toString();
                $state->name = $request->name;
                $state->parent_id = 1;
                $state->country_id = 1;
                $success = $state->update();

                if ($success) {

                    return response()->json([
                        'status' => 200,
                        'message' => 'State Updated Successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something Went Wrong. Please try again later.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not Found.'
                ]);
            }
        }
    }

    //Delete State
    public function destroy_states(Request $request, $id)
    {
        //Delete
        $state = State::find($id);

        if ($state) {
            $deleted = $state->delete();

            return response()->json([
                'status' => 200,
                'message' => 'State Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not Found.'
            ]);
        }
    }


    //Countries - CRUD
    public function countries()
    {
        $countries = Country::all();

        if ($countries) {
            return response()->json([
                'status' => 200,
                'message' => 'All Countries',
                'data' => $countries
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }

    //Show countries Details
    public function show_countries($id)
    {
        $countries = Country::where('id', $id)->first();

        if ($countries) {

            return response()->json([
                'status' => 200,
                'message' => 'Country Details',
                'data' => $countries
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    // Save Countries
    public function save_countries(Request $request)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $country = new Country();

        // $country->uuid = Uuid::uuid4()->toString();
        $country->name = $request->name;
        $country->parent_id = 1;
        $success = $country->save();

        if ($success) {
            return response()->json([
                'status' => 200,
                'message' => 'Country Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Something Went Wrong. Please try again later.'
            ]);
        }
    }

    // Update Cities
    public function update_countries(Request $request, $id)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $country = Country::where('id', $id)->first();

            if ($country) {

                // $city->uuid = Uuid::uuid4()->toString();
                $country->name = $request->name;
                $country->parent_id = 1;
                $success = $country->update();

                if ($success) {

                    return response()->json([
                        'status' => 200,
                        'message' => 'Country Updated Successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something Went Wrong. Please try again later.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not Found.'
                ]);
            }
        }
    }

    //Delete City
    public function destroy_countries(Request $request, $id)
    {
        //Delete
        $country = Country::find($id);

        if ($country) {
            $deleted = $country->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Country Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not Found.'
            ]);
        }
    }



    //Industries - CRUD
    public function industries()
    {
        $industries = Industry::all();

        if ($industries) {
            return response()->json([
                'status' => 200,
                'message' => 'All Industries',
                'data' => $industries
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }

    //Show Industry Details
    public function show_industries($id)
    {
        $industry = Industry::where('id', $id)->first();

        if ($industry) {

            return response()->json([
                'status' => 200,
                'message' => 'Industry Details',
                'data' => $industry
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    // Save Industries
    public function save_industries(Request $request)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $industry = new Industry();

        // $city->uuid = Uuid::uuid4()->toString();
        $industry->name = $request->name;
        $industry->parent_id = 1;
        $success = $industry->save();

        if ($success) {
            return response()->json([
                'status' => 200,
                'message' => 'Industry Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Something Went Wrong. Please try again later.'
            ]);
        }
    }

    // Update industries
    public function update_industries(Request $request, $id)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            //    'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $industry = Industry::where('id', $id)->first();

            if ($industry) {

                // $industry->uuid = Uuid::uuid4()->toString();
                $industry->name = $request->name;
                $industry->parent_id = 1;
                //    $industry->state_id = $request->state_id;
                $success = $industry->update();

                if ($success) {

                    return response()->json([
                        'status' => 200,
                        'message' => 'Industry Updated Successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something Went Wrong. Please try again later.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not Found.'
                ]);
            }
        }
    }

    //Delete Industry
    public function destroy_industries(Request $request, $id)
    {
        //Delete
        $industry = Industry::find($id);

        if ($industry) {
            $deleted = $industry->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Industry Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not Found.'
            ]);
        }
    }

    //jobtitles - CRUD
    public function jobtitles()
    {
        $jobtitles = JobTitle::all();

        if ($jobtitles) {
            return response()->json([
                'status' => 200,
                'message' => 'All Job Titles',
                'data' => $jobtitles
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }

    //Show jobtitles Details
    public function show_jobtitles($id)
    {
        $jobtitles = JobTitle::where('id', $id)->first();

        if ($jobtitles) {

            return response()->json([
                'status' => 200,
                'message' => 'Job Title Details',
                'data' => $jobtitles
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    // Save jobtitles
    public function save_jobtitles(Request $request)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $jobtitles = new JobTitle();

        $jobtitles->uuid = Uuid::uuid4()->toString();
        $jobtitles->name = $request->name;
        $jobtitles->parent_id = 1;
        $success = $jobtitles->save();

        if ($success) {
            return response()->json([
                'status' => 200,
                'message' => 'Job Title Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Something Went Wrong. Please try again later.'
            ]);
        }
    }

    // Update jobtitles
    public function update_jobtitles(Request $request, $id)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            //    'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $jobtitles = JobTitle::where('id', $id)->first();

            if ($jobtitles) {

                $jobtitles->uuid = Uuid::uuid4()->toString();
                $jobtitles->name = $request->name;
                $jobtitles->parent_id = 1;
                //    $jobtitles->state_id = $request->state_id;
                $success = $jobtitles->update();

                if ($success) {

                    return response()->json([
                        'status' => 200,
                        'message' => 'Job Title Updated Successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something Went Wrong. Please try again later.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not Found.'
                ]);
            }
        }
    }

    //Delete Jobtitles
    public function destroy_jobtitles(Request $request, $id)
    {
        //Delete
        $jobtitles = JobTitle::find($id);

        if ($jobtitles) {
            $deleted = $jobtitles->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Job Title Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not Found.'
            ]);
        }
    }

    //Companies - CRUD
    public function companies()
    {
        $companies = Company::all();

        if ($companies) {
            return response()->json([
                'status' => 200,
                'message' => 'All Companies',
                'data' => $companies
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data not Found'
            ]);
        }
    }

    //Show companies Details
    public function show_companies($id)
    {
        $company = Company::where('id', $id)->first();

        if ($company) {

            return response()->json([
                'status' => 200,
                'message' => 'Company Details',
                'data' => $company
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    // Save companies
    public function save_companies(Request $request)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // 'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $company = new Company();

        // $city->uuid = Uuid::uuid4()->toString();
        $company->name = $request->name;
        $company->parent_id = 1;
        $success = $company->save();

        if ($success) {
            return response()->json([
                'status' => 200,
                'message' => 'Company Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Something Went Wrong. Please try again later.'
            ]);
        }
    }

    // Update companies
    public function update_companies(Request $request, $id)
    {
        //input validation 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            //    'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $company = Company::where('id', $id)->first();

            if ($company) {

                // $company->uuid = Uuid::uuid4()->toString();
                $company->name = $request->name;
                $company->parent_id = 1;
                //    $company->state_id = $request->state_id;
                $success = $company->update();

                if ($success) {

                    return response()->json([
                        'status' => 200,
                        'message' => 'Company Updated Successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something Went Wrong. Please try again later.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not Found.'
                ]);
            }
        }
    }

    //Delete $company
    public function destroy_companies(Request $request, $id)
    {
        //Delete
        $company = Company::find($id);

        if ($company) {
            $deleted = $company->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Company Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not Found.'
            ]);
        }
    }
}
