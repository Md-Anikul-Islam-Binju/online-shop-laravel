@extends('admin.admin_layouts')
@section('admin_content')



    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">


      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Sub Category Table</h5>

        </div>

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Sub Category List
             <a href="#" class="btn btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add Sub Category</a>
          </h6>

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Id</th>
                  <th class="wd-15p">Category</th>
                  <th class="wd-15p">Sub Category Name</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>




              <tbody>
                @foreach($subcat as $row)
                <tr>
                  <td>{{( $row->id )}}</td>
                  <td>{{( $row->category_name )}}</td>
                  <td>{{( $row->subcategory_name )}}</td>
                  
                  <td>
                    <a href="{{URL::to('edit/subcategory/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{URL::to('delete/subcategory/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                  </td>
                </tr>
             	@endforeach
               
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->



     <div id="modaldemo3" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">**************************** Sub Category Add ****************************</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>



              @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                   @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                   @endforeach
                  </ul>
                </div>
              @endif

             <form action="{{route('store.subcategory')}}" method="post">
             @csrf
             <div class="modal-body pd-20">


             <div class="form-group">
               <label for="exampleInputCategory">Sub Category Name</label>
                <input type="text" class="form-control" name="subcategory_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sub Category Name">
             </div>


             <div class="form-group">
               <label for="exampleInputCategory">Category</label>
               <select class="form-control" name="category_id">
               	@foreach($category as $row)
               	<option value="{{ $row->id }}">{{( $row->category_name)}}</option>
               	@endforeach
               </select>
             </div>


              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
             </form>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->

      


@endsection
