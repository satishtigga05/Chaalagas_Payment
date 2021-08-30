<?php

namespace App\Http\Controllers;
use App\Models\securityappmodel;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;  
class securityappcontroller extends Controller
{







    // Function to save records

    public function savedata(Request $req){
       
             /* All Required Parameters by your Gateway will differ from gateway to gateway refer the gate manual */
      
             $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
             $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

             $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= 'TrxgYYoPbH';

    $amount = $req['amount'];
    $firstname = $req ['firstname'];
    $email = $req ['email'];
    $phone = $req ['phone'];

    $hash = strtolower(hash('sha512', $hash_string));

    
      $parameters = [
          'key' => '9Dkhrlk5',
        'txnid' => $txnid,
        'surl'=> "https://chaalagas.com/cng",
        'furl'=> 'lpgdomestic',
        'amount' => $amount,
        'firstname' => $firstname ,
        'email' => $email,
        'phone' => $phone,
        'productinfo' => 'Security Guard Application Form Fees',
        'amount'=> $amount
      ];
      
      $order = Indipay::prepare($parameters);
      return Indipay::process($order);

        $candidate = new securityappmodel;
            $candidate->firstname = $req ['firstname'];
            $candidate->middlename= $req ['middlename'];
            $candidate->lastname= $req ['lastname'];
            $candidate->mothername = $req ['mothername'];
            $candidate->fathername= $req ['fathername'];
            $candidate->mobile= $req ['phone'];
            $candidate->email= $req ['email'];
            $candidate->dob= $req ['dob'];
            $candidate->caste= $req ['caste'];
            $candidate->aadharnumber= $req ['aadharnumber'];
            $candidate->maritalstatus= $req ['maritalstatus'];
            $candidate->state= $req ['state'];
            $candidate->district= $req ['district'];
            $candidate->thesil= $req ['thesil'];
            $candidate->permanentaddress= $req ['permanentaddress'];
            $candidate->currentaddress= $req ['currentaddress'];
            $candidate->education= $req ['education'];
            $candidate->percentage= $req ['percentage'];
            $candidate->experience= $req ['experience'];
            $candidate->jobdivision= $req ['jobdivision'];
            $candidate->jobdistrict= $req ['jobdistrict'];
            $candidate-> save();

            $ref = $candidate->id;
            $name= $candidate->firstname;
            $candidate->referenceid = "CGPLSG2021100$ref";
            $newref =  $candidate->referenceid;
            $candidate->save();


            return redirect("/")->with('alert','Dear'.$name.' your Application is Successfully Submitted and Your Reference Nuber is'. $newref);
            
    }
}
