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
                <th>{{trans('admission::admission.testName')}}</th>
                <th>{{trans('admission::admission.testType')}}</th>
                <th>{{trans('admission::admission.grade')}}</th>
                <th>{{trans('admission::admission.divisions')}}</th>
                <th>{{trans('admission::admission.status')}}</th>
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
