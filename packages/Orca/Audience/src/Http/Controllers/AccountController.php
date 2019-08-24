<?php

namespace Orca\Audience\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orca\Audience\Repositories\AudienceRepository;
use Orca\Audience\Repositories\AudienceAddressRepository;
use Auth;

/**
 * Account Controlller for the audiences
 * basically will control the landing
 * behavior for custome and group of
 * audiences.
 *
 * @author    Prashant Singh <>
 *
 */
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;
    protected $audience;
    protected $address;


    public function __construct(AudienceRepository $audience, AudienceAddressRepository $address)
    {
        $this->middleware('audience');

        $this->_config = request('_config');

        $this->audience = $audience;

        $this->address = $address;
    }

    public function index() {
        return view($this->_config['view']);
    }
}
