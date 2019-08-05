<!-- Modal -->
<div class="modal fade" id="farmerRecordForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green">
              <h4 class="modal-title header-indigo text-center">Daily Record Form [ Name - {{ $farmer->name }} ]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" id="daily-record-form" action="{{ route('admin.daily-record', $farmer->id) }}">
                  @csrf
                  <div class="row">
                      <input type="hidden" name="farmer_id" value="{{ $farmer->id }}">

{{--                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">--}}
{{--                          <div class="form-group">--}}
{{--                              <label for="age"> Age</label>--}}
{{--                              <input type="number" name='age' class="form-control" id="age">--}}
{{--                          </div>--}}
{{--                      </div>--}}

                      <div class="col-4">
                          <div class="form-group">
                              <label class="">Date</label>
                              <div class="input-group date form_datetime" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                  <input class="form-control" size="16" type="text" name="date" value="{{ \Carbon\Carbon::now()->format('d M Y h:i a') }}">
                                  <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                              </div>
                              <input type="hidden" id="dtp_input1" value="" />
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <div class="form-group">
                              <label for="died"> Died</label>
                              <input type="number" name="died" class="form-control" id="died">
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <div class="form-group">
                              <label for="feed_kg"> Feed - kg</label>
                              <input type="number" name="feed" class="form-control" id="feed_kg">
                          </div>
                      </div>
                      {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <label for="feed_sack"> Feed - Sack</label>
                          <input type="number" class="form-control" id="feed_sack">
                      </div> --}}
                  </div>
                  <br>
                  <div class="row">
                      {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <label for="feed_left"> Feed Left</label>
                          <input type="number" class="form-control" id="feed_left">
                      </div> --}}
                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <div class="form-group">
                              <label for="weight"> Weight</label>
                              <input type="number" name="weight" class="form-control" id="weight">
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-3">
                          <div class="form-group">
                              <label for="sickness"> Symptom</label>
                              <input type="text" name="symptoms" id="symptoms" class="form-control">
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="form-group">
                              <label for="comment"> Comments</label>
                              <input type="text" name="comment"  class="form-control" id="comment">
                          </div>
                      </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary add-row" id="save">Save</button>
            </div>
          </div>
        </div>
      </div>
