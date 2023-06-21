@extends('customer::admin.layout')

@section('icon')
<i class="mdi mdi-account-search module-icon-svg-fill"></i>
@endsection

@section('title', _e('Clients', true))

@section('content')

<script type="text/javascript">
    $(document).ready(function () {
        $('.js-delete-all').hide();
        $(' input[type="checkbox"]').on('change', function () {
            var count = 0;
            $(' input[type="checkbox"]').each(function(){
                if($(this).prop('checked')) {
                    count++;
                    return;
                }

            })
            if(count > 0) {
                $('.js-delete-all').show();
            }
            else {
                $('.js-delete-all').hide();
            }
        });

        $(".js-select-all").click(function () {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            //$('.js-delete-all').toggle();
        });

        $('.js-delete-selected-form').submit(function (e) {
            e.preventDefault();

            var id = [];
            $("input[name='id']:checked").each(function () {
                id.push($(this).val());
            });

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: {id: id},
                success: function (data) {
                    window.location = window.location;
                }
            });
        });

    });
</script>


<div class="card col-xxl-10 col-md-11 col-12 px-md-0 px-2 mx-auto mb-5">
    <div class="card-body">
        <div class="row py-0">
            <form method="get">
                <input type="hidden" value="true" name="filter">

                <div class="card-header px-0 d-flex align-items-center flex-wrap justify-content-between">
                    <div class="col-md-6 col-12 ">

                        <h3 class="main-pages-title mb-0">
                            <?php _e('Clients list'); ?>
                        </h3>

                    </div>
                    <div class="col-md-6 col-12 text-end">
                        @if(request()->get('filter') == 'true')
                            <a href="{{route('admin.customers.index')}}" class="btn btn-outline-primary icon-left btn-md"><i class="mdi mdi-close"></i><?php _e('Filter'); ?> </a>
                        @else
                            <button type="button" class="btn btn-outline-dark me-2 js-show-filter" data-bs-toggle="collapse" data-bs-target="#show-filter"><?php _e('Filter'); ?></button>
                        @endif

                        <a href="{{ route('admin.customers.create') }}" class="btn btn-dark">
                            <svg fill="currentColor" class="me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M446.667 856V609.333H200v-66.666h246.667V296h66.666v246.667H760v66.666H513.333V856h-66.666Z"></path></svg>
                            <?php _e('New client'); ?>
                        </a>
                    </div>
                </div>

                <div class="collapse @if(request()->get('filter') == 'true') show @endif" id="show-filter">
                    <div class="row px-0">
                        <div class="col-md-6 col-12">
                            <label><?php _e('Search'); ?></label>
                            <input type="text" class="form-control" value="@if(request()->get('search')){{request()->get('search')}}@endif" name="search">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-outline-dark d-block"><?php _e('Apply'); ?></button>
                        </div>
                    </div>
                </div>
            </form>


            @if($customers->count()>0)
                <br/>

                <div class="actions">
                    <form method="POST" class="js-delete-selected-form" action="{{ route('admin.customers.delete') }}">
                        {{csrf_field()}}
                        <button class="btn btn btn-outline-danger js-delete-all" onclick="return confirm(mw.lang('Are you sure you want yo delete this?'))"><?php _e('Delete all'); ?></button>
                    </form>
                </div>

                <table class="table table-responsive mt-3 small vertical-align-middle fs-4">
                    <thead>
                    <tr>
                        <th class="border-0">
                            <div class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="js-select-all form-check-input" id="delete-all">
                                <label class="custom-control-label" for="delete-all">&nbsp;</label>
                            </div>
                        </th>
                        <th class="border-0 font-weight-bold">ID</th>
                        <th class="border-0 font-weight-bold"><?php _e('Client'); ?></th>
                        <th class="border-0 font-weight-bold"><?php _e('E-mail'); ?></th>
                        <th class="border-0 font-weight-bold"><?php _e('Phone'); ?></th>
                        <th class="border-0 font-weight-bold"><?php _e('City / Country'); ?></th>
                        {{--<th class="border-0 font-weight-bold"><?php _e('Amount Due'); ?></th>--}}
                        <th class="border-0 font-weight-bold text-center"><?php _e('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr class=" ">
                            <th>
                                <div class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" name="id" class="js-selected-customer form-check-input" id="delete-{{$customer->id}}" value="{{$customer->id}}">
                                    <label class="custom-control-label" for="delete-{{$customer->id}}">&nbsp;</label>
                                </div>
                            </th>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                    <?php
                                    $city = false;
                                    $country = false;
                                    if (isset($customer->addresses[0]->city)) {
                                        $city = $customer->addresses[0]->city;
                                    }
                                    if (isset($customer->addresses[0]->country_id)) {
                                        $findCountry = \MicroweberPackages\Country\Models\Country::where('id', $customer->addresses[0]->country_id)->first();
                                        if ($findCountry) {
                                            $country = $findCountry->name;
                                        }
                                    }

                                    echo $city;
                                    if ($country) {
                                        echo ' / ' . $country;
                                    }
                                    ?>
                            </td>
                            {{--<td>{{ number_format($customer->due_amount, 2) }}</td>--}}
                            <td class="text-center">
                                <form action="{{ route('admin.customers.destroy', $customer->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="tblr-body-color me-2 text-decoration-none" data-bs-toggle="tooltip" aria-label="Edit client" data-bs-original-title="Edit client">
                                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M180-180h44l443-443-44-44-443 443v44Zm614-486L666-794l42-42q17-17 42-17t42 17l44 44q17 17 17 42t-17 42l-42 42Zm-42 42L248-120H120v-128l504-504 128 128Zm-107-21-22-22 44 44-22-22Z"></path></svg>
                                    </a>
                                    <button type="submit" onclick="return confirm(mw.lang('Are you sure you want yo delete this?'))" class="text-danger border-0" style="background: none;" data-bs-toggle="tooltip" aria-label="Delete client" data-bs-original-title="Delete client">
                                        <svg class="me-1 text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                @if(request()->get('filter') == 'true')

                    <div class="no-items-found customers py-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="no-items-box" style="background-image: url('<?php print modules_url(); ?>microweber/api/libs/mw-ui/assets/img/no_clients.svg'); ">
                                    <h4><?php _e('No results found for this filter'); ?></h4>
                                    <p><?php _e('Try with a different filter'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                    <div class="no-items-found customers py-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="no-items-box" style="background-image: url('<?php print modules_url(); ?>microweber/api/libs/mw-ui/assets/img/no_clients.svg'); ">
                                    <h4><?php _e('You don’t have clients yet'); ?></h4>
                                    <p><?php _e('Here you can mange your clients'); ?></p>
                                    <br/>
                                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-rounded"><?php _e('Add client'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
