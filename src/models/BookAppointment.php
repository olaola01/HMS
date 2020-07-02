<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 30/06/2020
 * 2020
 **/


namespace Src\models;

use Src\databaseHelper\DatabaseObject;

class BookAppointment extends DatabaseObject
{
    static protected $table_name = "appointment";
    static protected $columns = ['doctorSpecialization', 'doctorId', 'userId', 'consultancyFees', 'appointmentDate','appointmentTime','userStatus', 'doctorStatus'];

    public $id;
    public $doctorSpecialization;
    public $doctorId;
    public $userId;
    public $consultancyFees;
    public $appointmentTime;
    public $appointmentDate;
    public $userStatus;
    public $doctorStatus;

    public function __construct($specilization,$doctorid,$userid,$fees,$appdate,$time,$userstatus,$docstatus)
    {
        $this->doctorSpecialization = $specilization;
        $this->doctorId = $doctorid;
        $this->userId = $userid;
        $this->consultancyFees = $fees;
        $this->appointmentTime = $time;
        $this->appointmentDate = $appdate;
        $this->userStatus = $userstatus;
        $this->doctorStatus = $docstatus;
    }
}