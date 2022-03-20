@extends('layouts.master')

@section('title')
    {{trans('main_trans.Grades')}}
@endsection

@section('css')
    @toastr_css
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('main_trans.Grades')}} </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active"> {{trans('main_trans.Grades')}} </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row justify-content-center">

        {{-- errors --}}
        {{--    $errors دي فانكشن متعرفه جاهزه ف لارفيل   --}}
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger container m-auto my-3 p-2 text-center" role="alert" style="width: 30%">
                    {{$error}}
                </div>
            @endforeach
        @endif

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('Grades_trans.add_Grade') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('Grades_trans.Name')}}</th>
                                <th>{{trans('Grades_trans.Notes')}}</th>
                                <th>{{trans('Grades_trans.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($Grades as $Grade)
                                {{$i++}}
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$Grade->Name}}</td>
                                    <td>{{$Grade->Notes}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $Grade->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $Grade->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


{{--    edit_modal_Grade    بنحط الموديل بتاع التعديل والحذف قبل م اقفل ال foreach عشان ياخدو ال id --}}
        <div class="modal fade" id="edit{{ $Grade->id }}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            {{ trans('Grades_trans.edit_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('Grades.update', 'test') }}" method="post">
                            {{ method_field('patch') }}
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="Name"
                                           class="form-control"
                                           value="{{ $Grade->getTranslation('Name', 'ar') }}"
                                           required>
                                    <input id="id" type="hidden" name="id" class="form-control"   {{-- عشان اوديه لل update --}}
                                           value="{{ $Grade->id }}">
                                </div>
                                <div class="col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control"
                                           value="{{ $Grade->getTranslation('Name', 'en') }}"
                                           name="Name_en" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="Notes"
                                          id="exampleFormControlTextarea1"
                                          rows="3">{{ $Grade->Notes }}</textarea>
                            </div>
                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


{{--  delete_modal_Grade  حذف مرحله  --}}
<div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    {{ trans('Grades_trans.delete_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Grades.destroy', 'test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    {{ trans('Grades_trans.Warning_Grade') }}
<br>
                    <div class="col">
                        <label for="Name"
                               class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                            :</label>
                        <input id="Name" type="text" name="Name"
                               class="form-control"
                               value="{{ $Grade->getTranslation('Name', 'ar') }}"
                               readonly>
                        <input id="id" type="hidden" name="id" class="form-control"   {{-- عشان اوديه لل update --}}
                        value="{{ $Grade->id }}">
                    </div>
                    <div class="col">
                        <label for="Name_en"
                               class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                            :</label>
                        <input type="text" class="form-control"
                               value="{{ $Grade->getTranslation('Name', 'en') }}"
                               name="Name_en" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                        <button type="submit"
                                class="btn btn-danger">{{ trans('Grades_trans.Sure') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

<!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Grades_trans.add_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('Grades.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="Name" class="form-control" required>
                                @error('Name')<span class="text-danger">{{ $message }}</span>@enderror {{-- عشان يطلعلي الايرورر بتاعه تحته --}}
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="Name_en" required>
                                @error('Name_en')<span class="text-danger">{{ $message }}</span>@enderror {{-- عشان يطلعلي الايرورر بتاعه تحته --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                :</label>
                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                            @error('Notes')<span class="text-danger">{{ $message }}</span>@enderror {{-- عشان يطلعلي الايرورر بتاعه تحته --}}
                        </div>
                        <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
