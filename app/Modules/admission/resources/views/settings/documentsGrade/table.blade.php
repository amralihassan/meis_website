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
                        <th>{{trans('admission::admission.gradeName')}}</th>
                        <th>{{trans('admission::admission.documentName')}}</th>                        
                        <th>{{trans('admission::admission.registrationType')}}</th>                        
                    </tr>
                </thead>
            
                <tbody>
                </tbody>
            </table>	
            {{Form::close()}}	      
        </div>
    </div>
</div>