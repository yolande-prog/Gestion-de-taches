<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Requests\Socials\SocialRequest;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialsController extends BaseController
{
    protected $social = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Social $social)
    {
        // $this->middleware('auth:api');
        $this->social = $social;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = $this->social->latest()->paginate(10);

        return $this->sendResponse($socials, 'Contract list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $socials = $this->social->pluck('name', 'id');

        return $this->sendResponse($socials, 'Social list');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Socials\SocialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $social = $this->social->create([
            'name' => $request->get('name'),
            'contract_name' => $request->get('contract_name'),
            'reconduction_name' => $request->get('reconduction_name'),
            'function' => $request->get('function'),
            'city' => $request->get('city'),
            'duration' => $request->get('duration'),
            'start_contract_date' =>  date('Y-m-d H:i:s' , strtotime($request->start_contract_date)),
            'end_contract_date' =>  date('Y-m-d H:i:s' , strtotime($request->end_contract_date)),
            'advance_notice_reconduction' => $request->get('advance_notice_reconduction'),
            'alarm1_date' =>  date('Y-m-d H:i:s' , strtotime($request->alarm1_date)),
            'alarm2_date' =>  date('Y-m-d H:i:s' , strtotime($request->alarm2_date)),
            'alarm3_date' =>  date('Y-m-d H:i:s' , strtotime($request->alarm3_date)),
            'observation' =>  $request->get('observation'),
        ]);
        return $this->sendResponse($social, 'Contrat Créer avec Succés');

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $social = $this->social->findOrFail($id);

        return $this->sendResponse($social, 'Social Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(SocialRequest $request, $id)
    {
        $social = $this->social->findOrFail($id);

        $social->update($request->all());

        // update pivot table
        // $tag_ids = [];
        // foreach ($request->get('tags') as $tag) {
        //     $tag_ids[] = $tag['id'];
        // }
        // $social->tags()->sync($tag_ids);

        return $this->sendResponse($social, 'Contrat Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // $this->authorize('isAdmin');

        $social = $this->social->findOrFail($id);

        $social->delete();

        return $this->sendResponse($social, 'social has been Deleted');
    }

    // public function upload(Request $request)
    // {
    //     $fileName = time() . '.' . $request->file->getClientOriginalExtension();
    //     $request->file->move(public_path('upload'), $fileName);

    //     return response()->json(['success' => true]);
    // }
}
