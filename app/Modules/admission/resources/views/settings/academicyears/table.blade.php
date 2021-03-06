<div class="row">
    <div class="col-xs-12">        
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div>
            {{Form::open(['id'=>'formData'])}}					
            <table id="dynamic-table" class="table display data-table" style="width: 100%">
                <thead>
                    <tr>
                        <th width="65px">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th width="65px">#</th>
                        <th>{{trans('admission::admission.academicYear')}}</th>
                        <th>{{trans('admission::admission.startFrom')}}</th>
                        <th>{{trans('admission::admission.endFrom')}}</th>
                        <th width="65px"></th>
                    </tr>
                </thead>
            
                <tbody>
                </tbody>
            </table>	
            {{Form::close()}}	      
        </div>
    </div>
</div>