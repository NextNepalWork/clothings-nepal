@extends('frontend.layouts.app')

@section('content')
<section class="page-header">
    <div class="overly"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="content text-center">
            <h1 class="mb-3">Ticket</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('support_ticket.index')}}">Support Ticket</a> </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
    <section class="user-dashboard page-wrapper">
    <div class="container">
        <div class="row">
            @include('frontend.inc.customer_side_nav')

            <div class="col-lg-9 col-md-12 col-12 mt-lg-0 mt-3">
                <div class="main-content dashboard-content">
                    <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" data-toggle="modal"
                        data-target="#ticket_modal">
                        <i class="fa fa-plus"></i>
                        <span class="d-block heading-6 strong-400 c-base-1">Create a Ticket</span>
                        </div>
                    </div>
                    </div>
                    <div class="card no-border mt-4 table-responsive">
                    <table class="table table-sm table-hover m-0">
                        <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Sending Date</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($tickets) > 0)
                                @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td>#{{ $ticket->code }}</td>
                                    <td>{{ $ticket->created_at }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>
                                    @if ($ticket->status == 'pending')
                                        <span class="badge badge-pill badge-danger">Pending</span>
                                    @elseif ($ticket->status == 'open')
                                        <span class="badge badge-pill badge-secondary">Open</span>
                                    @else
                                        <span class="badge badge-pill badge-success">Solved</span>
                                    @endif
                                    </td>
                                    <td>
                                    <a href="{{route('support_ticket.show', encrypt($ticket->id))}}"
                                        class="btn">
                                        View Details
                                        <i class="fa fa-angle-right text-sm"></i>
                                    </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center pt-5 h4" colspan="100%">
                                        <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                        <span class="d-block">{{ __('No history found.') }}</span>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    </div>
                    <!-- <div class="pagination-wrapper py-4">
                    <ul class="pagination justify-content-end">
                    </ul>
                    </div> -->
                </div>
            </div>


        </div>
    </div>
    </section>

<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Create a Ticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label>Provide a detailed description <span class="text-danger">*</span></label>
                        <textarea class="form-control editor" name="details" placeholder="Type your reply" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-2" class=" mw-100 mb-0">
                            <i class="fa fa-upload"></i>
                            <span>Attach files.</span>
                        </label>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{__('Send Ticket')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
