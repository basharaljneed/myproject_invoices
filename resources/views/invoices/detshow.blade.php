@extends('layouts.master')
@section('title')
    تفاصيل فاتورة
@stop
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')




    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>

    </div>





    @if (session()->has('delet'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delet') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif






    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif










    <div class="panel panel-primary tabs-style-2">
        <div class=" tab-menu-heading">
            <div class="tabs-menu1">

                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الفاتورة</a></li>
                    <li><a href="#tab6" class="nav-link" data-toggle="tab">مرفقات الفاتورة</a></li>
                </ul>









                <div class="card-body">
                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">إضافة مرفقات</h5>
                    <form method="post" action="{{ route('InvoiceAttachments.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file_name" required>
                            <input type="hidden" id="customFile" name="invoice_number"
                                value="{{ $invoice->invoice_number }}">
                            <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $invoice->id }}">
                            <label class="custom-file-label" for="customFile">حدد
                                المرفق</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-primary btn-sm " name="uploadedFile">تأكيد</button>
                    </form>
                </div>














            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">
                <div class="tab-pane active" id="tab4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">تاريخ الفاتورة</th>
                                        <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                        <th class="border-bottom-0">المنتج</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0">الخصم</th>
                                        <th class="border-bottom-0">مبلغ الإجمالي</th>
                                        <th class="border-bottom-0">مبلغ العمولة</th>
                                        <th class="border-bottom-0">نسبة الضريبة</th>
                                        <th class="border-bottom-0">قيمة الضريبة</th>
                                        <th class="border-bottom-0">الإجمالي</th>
                                        <th class="border-bottom-0">الحالة</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->Due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>
                                            {{ $invoice->refis->section_name }}
                                        </td>
                                        <td>{{ $invoice->Discount }}</td>
                                        <td>{{ $invoice->Amount_collection }}</td>
                                        <td>{{ $invoice->Amount_Commission }}</td>

                                        <td>{{ $invoice->Value_VAT }}</td>
                                        <td>{{ $invoice->Rate_VAT }}</td>
                                        <td>{{ $invoice->Total }}</td>
                                        <td>
                                            @if ($invoice->Value_Status == 1)
                                                <span class="text-success">{{ $invoice->Status }}</span>
                                            @elseif($invoice->Value_Status == 2)
                                                <span class="text-danger">{{ $invoice->Status }}</span>
                                            @else
                                                <span class="text-warning">{{ $invoice->Status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $invoice->note }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab5">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">المنتج</th>
                                        <th class="border-bottom-0">الحالة</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                        <th class="border-bottom-0">المستخدم</th>
                                        <th class="border-bottom-0">وقت الإنشاء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invo_dets as $invo_det)
                                        <tr>
                                            <td>{{ $invo_det->invoice_number }}</td>
                                            <td>{{ $invo_det->product }}</td>
                                            <td>{{ $invo_det->note }}</td>
                                            <td>{{ $invo_det->user }}</td>
                                            <td>
                                                @if ($invo_det->Value_Status == 1)
                                                    <span class="text-success">{{ $invoice->Status }}</span>
                                                @elseif($invo_det->Value_Status == 2)
                                                    <span class="text-danger">{{ $invo_det->Status }}</span>
                                                @else
                                                    <span class="text-warning">{{ $invo_det->Status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $invo_det->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab6">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">اسم الملف</th>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">المستخدم</th>
                                        <th class="border-bottom-0">وقت الإنشاء</th>
                                        <th class="border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($invo_attchs as $invo_attch)
                                        <tr>

                                            <td>{{ $invo_attch->file_name }}</td>
                                            <td>{{ $invo_attch->invoice_number }}</td>
                                            <td>{{ $invo_attch->Created_by }}</td>

                                            <td>{{ $invo_attch->created_at }}</td>
                                            <td>
                                                <a class="btn btn-outline-success btn-sm"
                                                    href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $invo_attch->file_name }}"
                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                    عرض</a>

                                                <a class="btn btn-outline-info btn-sm"
                                                    href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $invo_attch->file_name }}"
                                                    role="button"><i class="fas fa-download"></i>&nbsp;
                                                    تحميل</a>

                                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                    data-file_name="{{ $invo_attch->file_name }}"
                                                    data-invoice_number="{{ $invo_attch->invoice_number }}"
                                                    data-id_file="{{ $invo_attch->id }}"
                                                    data-target="#delete_file">حذف</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- deltee -->

            <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('Details_ddtt') }}" method="post">
                            @csrf
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <div class="modal-body">
                                <p class="text-center">
                                <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                </p>

                                <input type="text" name="id_file" id="id_file" value="">
                                <input type="text" name="file_name" id="file_name" value="">
                                <input type="text" name="invoice_number" id="invoice_number" value="">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)

        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>

@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>

@endsection
