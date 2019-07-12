<!-- Modal -->
<div class="modal fade" id="farmerRecordForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input Record</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" id="daily-record-form" action="{{ route('admin.daily-record', $farmer->id) }}">
                  @csrf
                  <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <label for="age"> Age</label>
                          <input type="number" name='age' class="form-control" id="age">
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <label for="died"> Died</label>
                          <input type="number" name="died" class="form-control" id="died">
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                          <label for="feed_kg"> Feed - kg</label>
                          <input type="number" name="feed" class="form-control" id="feed_kg">
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
                          <label for="weight"> Wieght</label>
                          <input type="number" name="weight" class="form-control" id="weight">
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-3">
                          <label for="sickness"> Sickness</label>
                          <input type="text" name="sickness" id="sickness" class="form-control">
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <label for="comment"> Comments</label>
                          <input type="text" name="comment"  class="form-control" id="comment">
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