   <!-- payment modal -->
   <div class="modal fade" id="payment-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <span class="badge badge-pill badge-success text-uppercase">Make payment</span>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <h4 class="modal-title text-capitalize" id="payment-modal-header">
                       Daily Parking Payment
                   </h4>
                   <p><span class="modal-title-sub">Daily parking</span> for <strong class="payment-plate"></strong>
                       <strong class="payment-zone"></strong>
                   </p>
                   <br>

                   <p class="mb-3">A payment request of <strong class="payment-amount"></strong> will be sent to
                       your
                       phone number
                       <strong>(<span class="payment-number"></span>)</strong> soon after you <strong>click</strong> the
                       pay
                       button below.
                       Make sure you have enough money in yor mpesa.
                   </p>

                   <p>
                       Once the payment request is sent to your phone, you will have <strong>50 seconds</strong> to
                       complete the payment by entering your <strong>Mpesa pin</strong> on your phone.
                   </p>
                   <p><strong>Click Pay</strong> below when ready to continue.</p>

                   <br>

                   <div class="form-group mb-0">
                       <div class="checkbox checkbox--inline">
                           <input type="checkbox" id="customCheck5">
                           <label class="checkbox__label" for="customCheck5">Add this vehicle to your
                               assets</label>
                       </div>
                   </div>

               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-process  text-capitalize btn-modal-pay">
                       <span class=" animated fade-In"><i class="mdi mdi-login mr-2"></i> Pay</span>
                       <!-- loader -->
                       <div class="timer-loader d-none animated fade-In">
                           <i class="mdi mdi-timer-outline mr-2"></i><strong>50 S</strong>
                       </div>
                       <!-- loader -->
                   </button>
               </div>
           </div>
       </div>
   </div>

   <!-- payment received modal -->
   <div class="modal fade" id="payment-received-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
       role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-body payment-modal">
                   <img src="{{ asset('img\icons\received.svg') }}" class="received-img">
                   <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                       Payment Received
                   </h4>
                   <hr>

                   <p>
                       <strong class="payment-amount"></strong> as your <strong class="payment-description"></strong>
                       fee.
                   </p>
                   <p>
                       Your <strong>receipt</strong> number is <strong class="receipt-number"></strong>.
                   </p>

                   <p>Thankyou for using our service. Have yourself a nice day.</p>

                   <div class="row bill-buttons mt-5">
                       <div class="col-10">
                           <a id="received-receipt-link" href="" class="btn-process btn-success w-100"><span
                                   class="ti-printer mr-2"></span>
                               Print Receipt</a>
                       </div>
                       <div class="col-2 pl-0">
                           <button class="btn-process-outline btn-outline-info w-100"
                               data-dismiss="modal">close</button>
                       </div>
                   </div>

                   <p class="mt-3">Narok County Government Parking</p>

               </div>

           </div>
       </div>
   </div>

   <!-- payment received modal -->
   <div class="modal fade" id="payment-cancelled-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
       role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-body payment-modal">
                   <img src="{{ asset('img\icons\cancelled.svg') }}" class="received-img">
                   <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                       Payment not received
                   </h4>
                   <hr>

                   <p>
                       Your payment was not received, you may have taken too long before entering your PIN.
                       <strong>Press retry</strong>
                       below or pay directly through mpesa by using the <strong> paybill number 272525</strong> and the
                       account your
                       account name is <strong class="payment-account"></strong>
                   </p>

                   <div class="row bill-buttons mt-5">
                       <div class="col-10">
                           <button class="btn-process-outline-black btn-success btn-pay-now btn-retry w-100"><span
                                   class="ti-reload mr-2"></span> Retry</button>
                       </div>
                       <div class="col-2 pl-0">
                           <button class="btn-process-outline btn-outline-info w-100"
                               data-dismiss="modal">close</button>
                       </div>
                   </div>

                   <p class="mt-3">Narok County Government Parking</p>

               </div>

           </div>
       </div>
   </div>

   <!-- payment received modal -->
   <div class="modal fade" id="remove-vehicle-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
       role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-body payment-modal">
                   <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                       remove car
                   </h4>
                   <hr>

                   <img src="{{ asset('img/icons/warning.svg') }}" class="received-img"
                       style="height: 130px; margin-bottom: 2rem;">
                   <h5>
                       <p id="record-name" class=""></p>
                   </h5>
                   <p class="d-none" id="p-code">
                   <p>
                       Are you sure you want to delete this car from the list of vehicles payable by this
                       transaction?
                   </p>

                   <div class="row mt-5">
                       <div class="col-10">
                           <button id="remove-entry"
                               class="btn-process-outline-black btn-success btn-pay-now btn-retry w-100">
                               <span class="ti-trash mr-2"></span> Remove from list
                           </button>
                       </div>
                       <div class="col-2 pl-0">
                           <button class="btn-process-outline btn-outline-info w-100"
                               data-dismiss="modal">Cancel</button>
                       </div>
                   </div>

                   <p class="mt-3">Narok County Government Parking</p>

               </div>

           </div>
       </div>
   </div>

   <!-- renew trade license -->
   <div class="modal fade trade-modal" id="trade-license-renewal" data-backdrop="static" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <div class="header-side">
                       <h4>Narok Trade License Renewal</h4>
                       <p>Fill in and remember to double check your details at each stage</p>
                   </div>

                   <i class="mdi mdi-close" data-dismiss="modal"></i>
               </div>
               <div class="modal-body" style="position: relative;">
                   <form>
                       <div class="slider d-none" style="z-index: 10; width: 100%">
                           <div class="line"></div>
                           <div class="subline inc"></div>
                           <div class="subline dec"></div>
                       </div>
                       <div class="slider-container wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business ID<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="businessID"
                                               placeholder="Enter Business ID">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business Name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="businessName"
                                               placeholder="Enter Business Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business Category<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="codeDescription" placeholder="Enter Business Category">
                                           <input type="hidden" class="form-control form-control-lg"
                                               name="ActivityCode">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Period<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select period" data-live-search="true" name="period">
                                               <option value="1">Yearly</option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Contact person name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="contactPersonName" placeholder="Enter Contact Person's Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Contact person telephone<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="ContactPersonTelephone1"
                                               placeholder="Enter Contact Person's Number">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Contact person ID<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="idDocumentNumber" placeholder="Enter Contact Person's Number">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Physical address<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="physicalAddress" placeholder="Enter Physical Address">
                                       </div>
                                   </div>
                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 1</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process btn-next btn-success">Next
                                           <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="slider-container d-none wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Additional business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Building name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="building"
                                               placeholder="Enter Building Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Building type<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Building Type" data-live-search="true" name="buildingType">
                                               <option value='1'>Storey</option>
                                               <option value='0'>Non storey</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Floor<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="floor"
                                               placeholder="Enter Floor Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Room<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="houseNumber"
                                               placeholder="Enter House Number">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Plot number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="plotNumber"
                                               placeholder="Enter Plot Number">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Sub county<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Sub County" data-live-search="true" id="Subcounty"
                                               name="subCountyCode">
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Ward<strong class="text-danger">*</strong></label>
                                           <div class="ward-ellipsis d-none">
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                           </div>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Ward" data-live-search="true" id="ward" name="wardCode">
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 2</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                           <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                           PREVIOUS
                                       </button>
                                       <button type="button" id="trade-license-submit"
                                           class="btn-process btn-success">SUBMIT
                                           <i class="mdi mdi-check-all"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <!-- apply for trade license -->
   <div class="modal fade trade-modal" id="trade-license-application" data-backdrop="static" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <div class="header-side">
                       <h4>Narok Trade License Registration</h4>
                       <p>Fill in and remember to double check your details at each stage</p>
                   </div>

                   <i class="mdi mdi-close" data-dismiss="modal"></i>
               </div>
               <div class="modal-body" style="position: relative;">
                   <form>
                       <div class="slider d-none" style="z-index: 10; width: 100%">
                           <div class="line"></div>
                           <div class="subline inc"></div>
                           <div class="subline dec"></div>
                       </div>
                       <div class="slider-container wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business Name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="RegBusinessName" placeholder="Enter Business Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Certificate of Incorporation</label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="ceriOfIncorporation"
                                               placeholder="Enter Business Certificate of your incorporation">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>KRA PIN number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="KRAPin"
                                               placeholder="Enter Business KRA PIN">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>VAT number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="VatNumber"
                                               placeholder="Enter Business VAT Number">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>P.O.BOX<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="pobox"
                                               placeholder="Enter P.O.Box">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Postal Code<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               id="postalCode" title="Select Postal Code" data-live-search="true"
                                               name="postalCode">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Postal Town<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="postalTown"
                                               id="town" placeholder="Enter Postal Name">
                                       </div>
                                   </div>
                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 1</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process btn-next btn-success">Next
                                           <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="slider-container d-none wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Additional business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="alert alert-danger d-none second-errors col-12" id="second_errors">
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business mobile number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" id="telephone1"
                                               name="telephone1" placeholder="Eg 07.........."
                                               value="{{ old('telephone1') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Alternative business mobile number<strong
                                                   class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="telephone2"
                                               value="{{ old('telephone2') }}" placeholder="Eg 07..........">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>FAX number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="faxNumber"
                                               placeholder="Enter the business fax number">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business email<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="newemail"
                                               placeholder="Eg businessemail@email.com" value="{{ old('newemail') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business physical address<strong
                                                   class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="newphysicalAddress" placeholder="Enter business location address"
                                               value="{{ old('newphysicalAddress') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Plot number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="newplotNumber"
                                               placeholder="Enter the business plot number"
                                               value="{{ old('newplotNumber') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Building name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="newbuildingName"
                                               placeholder="Enter the building name where the business is located"
                                               value="{{ old('newbuildingName') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Building type<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Building Type" data-live-search="true"
                                               name="newbuildingType">
                                               <option value='1'>Storey</option>
                                               <option value='0'>Non storey</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Floor<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="newfloor"
                                               placeholder="Enter Floor Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Room/Stall number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="newhouseNumber"
                                               placeholder="Enter House Number">
                                       </div>
                                   </div>

                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 2</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                           <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                           PREVIOUS
                                       </button>
                                       <button type="button" class="btn-process btn-next btn-success">Next
                                           <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="slider-container d-none wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Business owner's information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="alert alert-danger d-none second-errors col-12" id="third_errors">
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Owner's Title<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="contactPersonDesignation" placeholder="Eg Mr/Miss/Mrs etc"
                                               value="{{ old('contactPersonDesignation') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Owner's full name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="ContactPersonName" placeholder="Enter your full name"
                                               value="{{ old('ContactPersonName') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>ID document type<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Document Type" data-live-search="true" id="idTypeCode"
                                               name="idTypeCode">
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Document number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="idDocumentNumberNew" placeholder="Enter the document number"
                                               value="{{ old('idDocumentNumberNew') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Owners FAX number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="contactPersonFaxNumber" placeholder="Enter the owners fax number"
                                               value="{{ old('contactPersonFaxNumber') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Owner's mobile number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="contactPersonTelephone1" placeholder="Enter Owner's mobile number"
                                               value="{{ old('contactPersonTelephone1') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Alternative mobile number<strong
                                                   class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="contactPersonTelephone2"
                                               placeholder="Enter Alternative mobile number"
                                               value="{{ old('contactPersonTelephone2') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Owner's P.O. Box Number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               id="contactPersonPOBox" name="contactPersonPOBox"
                                               value="{{ old('contactPersonPOBox') }}">
                                           @if (Session::has('resource'))
                                               <input type="hidden" class="form-control form-control-lg" id="updatedBy"
                                                   name="updatedBy"
                                                   value="{{ Session::get('resource')['user_full_name'] }}">
                                           @else
                                               <input type="hidden" class="form-control form-control-lg" id="updatedBy"
                                                   name="updatedBy" value="Self service portal">
                                           @endif
                                           <input type="hidden" class="form-control form-control-lg"
                                               id="operationalStatus" name="operationalStatus" value="1">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Postal code <strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Postal Code" data-live-search="true"
                                               id="contactPersonPostalCode" name="contactPersonPostalCode">
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Postal town<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="contactPersonTown" placeholder="Enter Alternative mobile number"
                                               id="contactPersonTown" value="{{ old('contactPersonTown') }}">
                                       </div>
                                   </div>

                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 3</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                           <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                           PREVIOUS
                                       </button>
                                       <button type="button" class="btn-process btn-next btn-success">Next
                                           <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="slider-container d-none wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Activity information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="alert alert-danger d-none second-errors col-12" id="third_errors">
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Activity description<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="businessActivityDescription"
                                               placeholder="Enter a description of what the business does"
                                               value="{{ old('businessActivityDescription') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Area (M<sup>2</sup>) <strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="premisesArea"
                                               placeholder="Enter the area occupied by the business"
                                               value="{{ old('premisesArea') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Other details<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="otherBusinessClassificationDetails"
                                               placeholder="Enter additional relevant details about the business"
                                               value="{{ old('otherBusinessClassificationDetails') }}">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Sub county<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Sub County" data-live-search="true" id="NewSubcounty"
                                               name="NewSubcounty">
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Ward<strong class="text-danger">*</strong></label>
                                           <div class="ward-ellipsis d-none">
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                           </div>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Ward" data-live-search="true" id="Newward"
                                               name="NewwardCode">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business activity<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Business Activity" data-live-search="true"
                                               id="businessActivity" name="businessActivity">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Sub categories <strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Sub categories " data-live-search="true"
                                               id="newactivityCode" name="newactivityCode">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Number of employees<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="numberOfEmployees" placeholder="Enter the number of employees"
                                               value="{{ old('numberOfEmployees') }}">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Size of business <strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Size of business" data-live-search="true" id="relativeSize"
                                               name="relativeSize">
                                               <option value="1">Small</option>
                                               <option value="2">Medium</option>
                                               <option value="3">Large</option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Payment plan <strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select Payment Plan" data-live-search="true" id="NewPeriod"
                                               name="NewPeriod">
                                               <option value="1">Yearly</option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="form-group col-md-12 col-lg-4 mt-2 d-none" id="sbp_charges">

                                   </div>


                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 4</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                           <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                           PREVIOUS
                                       </button>
                                       <button type="button" id="trade-license-submit-application"
                                           class="btn-process btn-success">SUBMIT
                                           <i class="mdi mdi-check-all"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <!-- apply for food handlers -->
   <div class="modal fade trade-modal" id="food-handlers-application" data-backdrop="static" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <div class="header-side">
                       <h4>Individual Food Handler Certificate Registration</h4>
                       <p>Fill in and remember to double check your details at each stage</p>
                   </div>

                   <i class="mdi mdi-close" data-dismiss="modal"></i>
               </div>
               <div class="modal-body" style="position: relative;">
                   <form>
                       <div class="slider d-none" style="z-index: 10; width: 100%">
                           <div class="line"></div>
                           <div class="subline inc"></div>
                           <div class="subline dec"></div>
                       </div>
                       <div class="slider-container wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Personal information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>First name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('handlers-firstName') }}" name="handlers-firstName"
                                               placeholder="Enter First name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Other Names<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('handlers-otherNames') }}" name="handlers-otherNames"
                                               placeholder="Enter Other Names">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Gender<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select gender" data-live-search="true" name="handlers-gender">
                                               <option value="Female"> Female </option>
                                               <option value="Male"> Male </option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>ID Type<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select idType" data-live-search="true" name="handlers-idType">
                                               <option value="1"> National Id </option>
                                               <option value="2"> Passport </option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>ID Number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" name="handlers-idNo"
                                               placeholder="Enter ID Number" value="{{ old('handlers-idNo') }}">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Mobile Number<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="handlers-mobile" placeholder="Enter Mobile Number"
                                               value="{{ old('handlers-mobile') }}">
                                       </div>
                                   </div>

                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 1</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process btn-next btn-success">Next
                                           <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="slider-container d-none wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Street/Location<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('handlers-address') }}" name="handlers-address"
                                               placeholder="Enter the location of the business">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Employement Status<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               title="Select employment status" data-live-search="true"
                                               name="handlers-selfEmployed">
                                               <option value="1"> Employed </option>
                                               <option value="2"> Self employed </option>
                                               <option value="3"> Not employed </option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Postal Code<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('handlers-postalCode') }}" name="handlers-postalCode"
                                               placeholder="Enter the postalCode of the business">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Town<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('handlers-town') }}" name="handlers-town"
                                               placeholder="Enter the town of the business">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>County<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" value="Narok"
                                               name="handlers-county" placeholder="Enter the county of the business">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Sub County<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               id="handlers-subcounty" title="Select Sub County" data-live-search="true"
                                               name="handlers-subcounty">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Ward<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               id="handlers-ward" title="Select Ward" data-live-search="true"
                                               name="handlers-ward">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business / Corporate ID<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('handlers-corporateId') }}" name="handlers-corporateId"
                                               placeholder="Enter Id or (NA if Not employed)">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Work Group<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               id="handlers-workGroupId" title="Select Work Group"
                                               data-live-search="true" name="handlers-workGroupId">
                                               <option value="4"> Food Handlers </option>
                                               <option value="1"> Truck Drivers </option>
                                               <option value="2"> Taxi Drivers </option>
                                               <option value="3"> PSV Operators </option>
                                               <option value="5"> Medical Practioners </option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 2</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                           <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                           PREVIOUS
                                       </button>
                                       <button type="button" id="handler-license-submit"
                                           class="btn-process btn-success">SUBMIT
                                           <i class="mdi mdi-check-all"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <!-- apply for food handlers -->
   <div class="modal fade trade-modal" id="food-hygiene-application" data-backdrop="static" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <div class="header-side">
                       <h4>Food Hygiene Certificate Registration</h4>
                       <p>Fill in and remember to double check your details at each stage</p>
                   </div>

                   <i class="mdi mdi-close" data-dismiss="modal"></i>
               </div>
               <div class="modal-body" style="position: relative;">
                   <form>
                       <div class="slider d-none" style="z-index: 10; width: 100%">
                           <div class="line"></div>
                           <div class="subline inc"></div>
                           <div class="subline dec"></div>
                       </div>
                       <div class="slider-container wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business name<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('hygiene-businessName') }}" name="hygiene-businessName"
                                               placeholder="Enter Business Name">
                                       </div>
                                   </div>
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Business ID<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('hygiene-businessID') }}" name="hygiene-businessID"
                                               placeholder="Enter Business ID">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Telephone 1<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="hygiene-telephone1" placeholder="Enter Telephone 1"
                                               value="{{ old('hygiene-telephone1') }}">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Telephone 2<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="hygiene-telephone2" placeholder="Enter Telephone 2"
                                               value="{{ old('hygiene-telephone2') }}">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Physical address<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="hygiene-address" placeholder="Enter Physical Address"
                                               value="{{ old('hygiene-address') }}">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Postal Code<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               name="hygiene-postalcode" placeholder="Enter Postal Code"
                                               value="{{ old('hygiene-postalcode') }}">
                                       </div>
                                   </div>

                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 1</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process btn-next btn-success">Next
                                           <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="slider-container d-none wow animated slideInLeft">
                           <div class="card">
                               <div class="card-header">
                                   <h5>Additional Business information</h5>
                                   <p>Please fill all the required(*) fields.</p>
                               </div>
                               <div class="card-body row">
                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>County<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg" value="Narok"
                                               name="hygiene-county" placeholder="Enter the county of the business">
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Sub County<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               id="hygiene-subcounty" title="Select Sub County" data-live-search="true"
                                               name="hygiene-subcounty">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Ward<strong class="text-danger">*</strong></label>
                                           <select class="selectpicker show-tick  w-100 form-control no-btn"
                                               id="hygiene-ward" title="Select Ward" data-live-search="true"
                                               name="hygiene-ward">
                                           </select>
                                       </div>
                                   </div>

                                   <div class="col-sm-12 col-md-4">
                                       <div class="form-group">
                                           <label>Town<strong class="text-danger">*</strong></label>
                                           <input type="text" class="form-control form-control-lg"
                                               value="{{ old('hygiene-town') }}" name="hygiene-town"
                                               placeholder="Enter the town of the business">
                                       </div>
                                   </div>

                                   <div class="col-12 modal-nav">
                                   </div>
                               </div>
                               <div class="card-footer d-flex justify-content-between">
                                   <span>STEP 2</span>
                                   <div class="modal-footer-buttons">
                                       <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                           <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                           PREVIOUS
                                       </button>
                                       <button type="button" id="hygiene-license-submit"
                                           class="btn-process btn-success">SUBMIT
                                           <i class="mdi mdi-check-all"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

   <!-- Food Handler Notification Modal -->
   <div class="modal fade" id="pending-loader" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
       aria-hidden="true" data-backdrop="static" data-keyboard="false">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content radius-0">
               <div class="modal-header d-none">
                   <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <center class="pt-3">
                       <div class="the-loader animated fade-in">
                           <div class="lds-spinner">
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                               <div></div>
                           </div>
                           <h2>Processing request</h2>
                           <p>Kindly be patient as your request is being processed. this will take a few minute.</p>
                       </div>

                       <div class="notification-success kev-notification d-none animated fade-in">
                           <img src="{{ asset('img\icons\received.svg') }}" class="notification-img">
                           <h2>Created successfully</h2>
                           <p>Your food handler certificate has been created successfully</p>
                       </div>

                       <div class="notification-warning kev-notification d-none animated fade-in">
                           <img src="{{ asset('img\icons\cancelled.svg') }}" class="notification-img">
                           <h2>We are sorry</h2>
                           <p>There seems to be an issue while processing your request. Probably its an empty field on
                               one
                               of the <strong>required (<strong class="text-danger">*</strong>)
                                   fields</strong>.<br>Double
                               check to ensure or <strong>Required fields are not empty</strong> Contact customer care
                               desk
                               if it persists.</p>
                       </div>

                       <div class="notification-danger kev-notification d-none animated fade-in">
                           <img src="{{ asset('img/notifications/error.svg') }}" class="notification-img">
                           <h2>Something went wrong</h2>
                           <p>Sorry, we ran into an error while processing your request. Kindly retry the process if it
                               persists contact our customer service desk.</p>
                       </div>

                       <div class="notification-registered kev-notification d-none animated fade-in">
                           <img src="{{ asset('img/notifications/warning.svg') }}" class="notification-img">
                           <h2>Something went wrong</h2>
                           <p>Sorry, we ran into an error while processing your request. Kindly retry the process if it
                               persists contact our customer service desk.</p>
                       </div>

                   </center>
               </div>
               <div class="modal-footer d-none">
                   <center>
                       <button type="button" class="btn-process btn-large btn-info px-5 text-uppercase"
                           data-dismiss="modal">ok</button>
                   </center>
               </div>
           </div>
       </div>
   </div>

   <!-- Food Handler OTP Modal -->
   <div class="modal fade" id="details-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
       aria-hidden="true" data-backdrop="static" data-keyboard="false">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-body payment-modal">
                   <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                       Enter the PIN sent to your phone
                   </h4>
                   <hr>

                   <div class="transactions-details-container w-100">
                       <form>
                           <div id="opt_errors" class="alert alert-danger d-none"></div>
                           <div id="pin_errors" class="alert alert-danger d-none"></div>
                           <div class="form-group col-12">
                               <label for="number-plate" class=" ">PIN</label>
                               <input type="text" class="form-control w-100 text-uppercase" id="slip-amount"
                                   placeholder="Enter pin sent to your phone" name="slip-pin"
                                   value="{{ old('slip-pin') }}">
                           </div>

                           <div class="form-group mt-2 pt-2 col-12">
                               <div class="row">
                                   <div class="col-9 text-uppercase">
                                       <button class="btn-process btn-block mt-0 d-none" id="check-otp">
                                           <div class="btn-txt animated">
                                               <span class="btn-text text-uppercase font-12">Check for Results</span>
                                               <i class="ti-arrow-right ml-2"></i>
                                           </div>
                                           <div class="btn-ellipsis d-none">
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                           </div>
                                       </button>

                                       <button class="btn-process btn-block mt-0 d-none" id="check-corporate-otp">
                                           <div class="btn-txt animated">
                                               <span class="btn-text text-uppercase font-12">Check for
                                                   Certificates</span>
                                           </div>
                                           <div class="btn-ellipsis d-none">
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                               <div></div>
                                           </div>
                                       </button>
                                   </div>
                                   <div class="col-3 pl-2">
                                       <button class="btn-process-outline btn-outline-info w-100"
                                           data-dismiss="modal">close</button>
                                   </div>
                               </div>
                           </div>
                       </form>
                       <!--  -->
                       <br><br>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Food Handler Notification Modal -->
