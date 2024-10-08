@extends('welcome')
@section('konten')
<button type="button" data-toggle="modal" data-target="#import" class="inline-block px-8 py-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-fuchsia-500 text-fuchsia-500 hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-fuchsia-500 active:bg-fuchsia-500 active:text-white hover:active:border-fuchsia-500 hover:active:bg-transparent hover:active:text-fuchsia-500 hover:active:opacity-75">Import</button>
 
<div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-opacity ease-linear opacity-0 z-sticky outline-0" id="import" aria-hidden="true">
  <div class="relative w-auto m-2 transition-transform duration-300 pointer-events-none sm:m-7 sm:max-w-125 sm:mx-auto lg:mt-48 ease-soft-out -translate-y-13">
    <div class="relative flex flex-col w-full bg-white border border-solid pointer-events-auto dark:bg-gray-950 bg-clip-padding border-black/20 rounded-xl outline-0">
      <div class="flex items-center justify-between p-4 border-b border-solid shrink-0 border-slate-100 rounded-t-xl">
        <h5 class="mb-0 leading-normal dark:text-white" id="ModalLabel">Import CSV</h5>
        <i class="ml-4 fas fa-upload"></i>
        <button type="button" data-toggle="modal" data-target="#import" class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2 " data-dismiss="modal"></button>
      </div>
      <div class="relative flex-auto p-4">
        <p>You can browse your computer for a file.</p>
        <input action="/file-upload" dropzone type="text" placeholder="Browse file..." class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
        <div class="min-h-6 pl-7 mb-0.5 block">
          <input class="w-5 h-5 ease-soft -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" value="" id="importCheck" checked="">
          <label class="inline-block mb-2 ml-1 font-bold cursor-pointer select-none text-xs text-slate-700 dark:text-white/80" for="importCheck">I accept the terms and conditions</label>
        </div>
      </div>
      <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
        <button type="button" data-toggle="modal" data-target="#import" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
        <button type="button" data-toggle="modal" data-target="#import" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Upload</button>
      </div>
    </div>
  </div>
</div>
        <div class="flex flex-wrap -mx-3">
          <div class="max-w-full px-3 lg:w-2/3 lg:flex-none">
            <div class="flex flex-wrap -mx-3">
              <div class="w-full max-w-full px-3 mb-4 xl:mb-0 xl:w-1/2 xl:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                  <div class="relative overflow-hidden rounded-2xl" style="background-image: url('../assets/img/curved-images/curved14.jpg')">
                    <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                    <div class="relative z-10 flex-auto p-4">
                      <i class="p-2 text-white fas fa-wifi"></i>
                      <h5 class="pb-2 mt-6 mb-12 text-white">4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                      <div class="flex">
                        <div class="flex">
                          <div class="mr-6">
                            <p class="mb-0 leading-normal text-white text-sm opacity-80">Card Holder</p>
                            <h6 class="mb-0 text-white">Jack Peterson</h6>
                          </div>
                          <div>
                            <p class="mb-0 leading-normal text-white text-sm opacity-80">Expires</p>
                            <h6 class="mb-0 text-white">11/22</h6>
                          </div>
                        </div>
                        <div class="flex items-end justify-end w-1/5 ml-auto">
                          <img class="w-3/5 mt-2" src="../assets/img/logos/mastercard.png" alt="logo" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full max-w-full px-3 xl:w-1/2 xl:flex-none">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                      <div class="p-4 mx-6 mb-0 text-center bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="w-16 h-16 text-center bg-center icon bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl rounded-xl">
                          <i class="relative text-white opacity-100 fas fa-landmark text-xl top-31/100"></i>
                        </div>
                      </div>
                      <div class="flex-auto p-4 pt-0 text-center">
                        <h6 class="mb-0 text-center">Salary</h6>
                        <span class="leading-tight text-xs">Belong Interactive</span>
                        <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                        <h5 class="mb-0">+$2000</h5>
                      </div>
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 mt-6 md:mt-0 md:w-1/2 md:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                      <div class="p-4 mx-6 mb-0 text-center bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="w-16 h-16 text-center bg-center icon bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl rounded-xl">
                          <i class="relative text-white opacity-100 fab fa-paypal text-xl top-31/100"></i>
                        </div>
                      </div>
                      <div class="flex-auto p-4 pt-0 text-center">
                        <h6 class="mb-0 text-center">Paypal</h6>
                        <span class="leading-tight text-xs">Freelance Payment</span>
                        <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                        <h5 class="mb-0">$455.00</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
                <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                  <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap -mx-3">
                      <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                        <h6 class="mb-0">Payment Method</h6>
                      </div>
                      <div class="flex-none w-1/2 max-w-full px-3 text-right">
                        <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="javascript:;"> <i class="fas fa-plus"> </i>&nbsp;&nbsp;Add New Card</a>
                      </div>
                    </div>
                  </div>
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                      <div class="max-w-full px-3 mb-6 md:mb-0 md:w-1/2 md:flex-none">
                        <div class="relative flex flex-row items-center flex-auto min-w-0 p-6 break-words bg-transparent border border-solid shadow-none rounded-xl border-slate-100 bg-clip-border">
                          <img class="mb-0 mr-4 w-1/10" src="../assets/img/logos/mastercard.png" alt="logo" />
                          <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                          <i class="ml-auto cursor-pointer fas fa-pencil-alt text-slate-700" data-target="tooltip_trigger" data-placement="top"></i>
                          <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm">
                            Edit Card
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                          </div>
                        </div>
                      </div>
                      <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                        <div class="relative flex flex-row items-center flex-auto min-w-0 p-6 break-words bg-transparent border border-solid shadow-none rounded-xl border-slate-100 bg-clip-border">
                          <img class="mb-0 mr-4 w-1/10" src="../assets/img/logos/visa.png" alt="logo" />
                          <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248</h6>
                          <i class="ml-auto cursor-pointer fas fa-pencil-alt text-slate-700" data-target="tooltip_trigger" data-placement="top"></i>
                          <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm">
                            Edit Card
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 lg:w-1/3 lg:flex-none">
            <color:div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                    <h6 class="mb-0">Invoices</h6>
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                    <button class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-fuchsia-500 hover:opacity-75">View All</button>
                  </div>
                </div>
              </div>
              <div class="flex-auto p-4 pb-0">
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">March, 01, 2020</h6>
                      <span class="leading-tight text-xs">#MS-415646</span>
                    </div>
                    <div class="flex items-center leading-normal text-sm">
                      $180
                      <button class="inline-block px-0 py-3 mb-0 ml-6 font-bold leading-normal text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer ease-soft-in bg-150 text-sm active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 text-slate-700"><i class="mr-1 fas fa-file-pdf text-lg"></i> PDF</button>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">February, 10, 2021</h6>
                      <span class="leading-tight text-xs">#RV-126749</span>
                    </div>
                    <div class="flex items-center leading-normal text-sm">
                      $250
                      <button class="inline-block px-0 py-3 mb-0 ml-6 font-bold leading-normal text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer ease-soft-in bg-150 text-sm active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 text-slate-700"><i class="mr-1 fas fa-file-pdf text-lg"></i> PDF</button>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">April, 05, 2020</h6>
                      <span class="leading-tight text-xs">#FB-212562</span>
                    </div>
                    <div class="flex items-center leading-normal text-sm">
                      $560
                      <button class="inline-block px-0 py-3 mb-0 ml-6 font-bold leading-normal text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer ease-soft-in bg-150 text-sm active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 text-slate-700"><i class="mr-1 fas fa-file-pdf text-lg"></i> PDF</button>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">June, 25, 2019</h6>
                      <span class="leading-tight text-xs">#QW-103578</span>
                    </div>
                    <div class="flex items-center leading-normal text-sm">
                      $120
                      <button class="inline-block px-0 py-3 mb-0 ml-6 font-bold leading-normal text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer ease-soft-in bg-150 text-sm active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 text-slate-700"><i class="mr-1 fas fa-file-pdf text-lg"></i> PDF</button>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 bg-white border-0 rounded-b-inherit rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">March, 01, 2019</h6>
                      <span class="leading-tight text-xs">#AR-803481</span>
                    </div>
                    <div class="flex items-center leading-normal text-sm">
                      $300
                      <button class="inline-block px-0 py-3 mb-0 ml-6 font-bold leading-normal text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer ease-soft-in bg-150 text-sm active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 text-slate-700"><i class="mr-1 fas fa-file-pdf text-lg"></i> PDF</button>
                    </div>
                  </li>
                </ul>
              </div>
            </color:div>
          </div>
        </div>

        <div class="flex flex-wrap -mx-3">
          <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <h6 class="mb-0">Billing Information</h6>
              </div>
              <div class="flex-auto p-4 pt-6">
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50">
                    <div class="flex flex-col">
                      <h6 class="mb-4 leading-normal text-sm">Oliver Liam</h6>
                      <span class="mb-2 leading-tight text-xs">Company Name: <span class="font-semibold text-slate-700 sm:ml-2">Viking Burrito</span></span>
                      <span class="mb-2 leading-tight text-xs">Email Address: <span class="font-semibold text-slate-700 sm:ml-2">oliver@burrito.com</span></span>
                      <span class="leading-tight text-xs">VAT Number: <span class="font-semibold text-slate-700 sm:ml-2">FRB1235476</span></span>
                    </div>
                    <div class="ml-auto text-right">
                      <a class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" href="javascript:;"><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                      <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700" href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700" aria-hidden="true"></i>Edit</a>
                    </div>
                  </li>
                  <li class="relative flex p-6 mt-4 mb-2 border-0 rounded-xl bg-gray-50">
                    <div class="flex flex-col">
                      <h6 class="mb-4 leading-normal text-sm">Lucas Harper</h6>
                      <span class="mb-2 leading-tight text-xs">Company Name: <span class="font-semibold text-slate-700 sm:ml-2">Stone Tech Zone</span></span>
                      <span class="mb-2 leading-tight text-xs">Email Address: <span class="font-semibold text-slate-700 sm:ml-2">lucas@stone-tech.com</span></span>
                      <span class="leading-tight text-xs">VAT Number: <span class="font-semibold text-slate-700 sm:ml-2">FRB1235476</span></span>
                    </div>
                    <div class="ml-auto text-right">
                      <a class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" href="javascript:;"><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                      <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700" href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700" aria-hidden="true"></i>Edit</a>
                    </div>
                  </li>
                  <li class="relative flex p-6 mt-4 mb-2 border-0 rounded-b-inherit rounded-xl bg-gray-50">
                    <div class="flex flex-col">
                      <h6 class="mb-4 leading-normal text-sm">Ethan James</h6>
                      <span class="mb-2 leading-tight text-xs">Company Name: <span class="font-semibold text-slate-700 sm:ml-2">Fiber Notion</span></span>
                      <span class="mb-2 leading-tight text-xs">Email Address: <span class="font-semibold text-slate-700 sm:ml-2">ethan@fiber.com</span></span>
                      <span class="leading-tight text-xs">VAT Number: <span class="font-semibold text-slate-700 sm:ml-2">FRB1235476</span></span>
                    </div>
                    <div class="ml-auto text-right">
                      <a class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" href="javascript:;"><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                      <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700" href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700" aria-hidden="true"></i>Edit</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
            <div class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <div class="flex flex-wrap -mx-3">
                  <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                    <h6 class="mb-0">Your Transactions</h6>
                  </div>
                  <div class="flex items-center justify-end max-w-full px-3 md:w-1/2 md:flex-none">
                    <i class="mr-2 far fa-calendar-alt"></i>
                    <small>23 - 30 March 2020</small>
                  </div>
                </div>
              </div>
              <div class="flex-auto p-4 pt-6">
                <h6 class="mb-4 font-bold leading-tight uppercase text-xs text-slate-500">Newest</h6>
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                    <div class="flex items-center">
                      <button class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-red-600 border-transparent bg-transparent text-center align-middle font-bold uppercase text-red-600 transition-all hover:opacity-75"><i class="fas fa-arrow-down text-3xs"></i></button>
                      <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-sm text-slate-700">Netflix</h6>
                        <span class="leading-tight text-xs">27 March 2020, at 12:30 PM</span>
                      </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                      <p class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-red-600 to-rose-400 text-sm bg-clip-text">- $ 2,500</p>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                    <div class="flex items-center">
                      <button class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                      <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-sm text-slate-700">Apple</h6>
                        <span class="leading-tight text-xs">27 March 2020, at 04:30 AM</span>
                      </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                      <p class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">+ $ 2,000</p>
                    </div>
                  </li>
                </ul>
                <h6 class="my-4 font-bold leading-tight uppercase text-xs text-slate-500">Yesterday</h6>
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                    <div class="flex items-center">
                      <button class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                      <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-sm text-slate-700">Stripe</h6>
                        <span class="leading-tight text-xs">26 March 2020, at 13:45 PM</span>
                      </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                      <p class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">+ $ 750</p>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                    <div class="flex items-center">
                      <button class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                      <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-sm text-slate-700">HubSpot</h6>
                        <span class="leading-tight text-xs">26 March 2020, at 12:30 PM</span>
                      </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                      <p class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">+ $ 1,000</p>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                    <div class="flex items-center">
                      <button class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                      <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-sm text-slate-700">Creative Tim</h6>
                        <span class="leading-tight text-xs">26 March 2020, at 08:30 AM</span>
                      </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                      <p class="relative z-10 items-center inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">+ $ 2,500</p>
                    </div>
                  </li>
                  <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                    <div class="flex items-center">
                      <button class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-slate-700 border-transparent bg-transparent text-center align-middle font-bold uppercase text-slate-700 transition-all hover:opacity-75"><i class="fas fa-exclamation text-3xs"></i></button>
                      <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-sm text-slate-700">Webflow</h6>
                        <span class="leading-tight text-xs">26 March 2020, at 05:00 AM</span>
                      </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                      <p class="flex items-center m-0 font-semibold leading-normal text-sm text-slate-700">Pending</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
@endsection
