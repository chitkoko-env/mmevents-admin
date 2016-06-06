<div class="container-fluid card" ng-controller="township_list">

   <title>Township List</title>
   <div class="header row">
      <i class="fa fa-map-marker"></i> Township List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
              <a class="btn btn-default" ng-click="opentownshipdialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Township</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="finddata(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredTownship.length}} | Total : {{townshiplst.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="searchObjResults">
        <thead>
          <tr>
            <th>City</th>   
            <th>Township</th>
            <th>Action</th>    
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="c in filteredTownship | filter:search:strict" style="cursor:pointer;">
            <td ng-show="filteredTownship[$index].city_id==filteredTownship[$index-1].city_id">&nbsp;</td>
            <td ng-show="filteredTownship[$index].city_id!=filteredTownship[$index-1].city_id">{{c.city_name}}</td>
            <td>{{c.township_name}}</td>
            <td>
              <a class="btn btn-default" ng-click="opentownshipeditdialog(c,'md')">
              <i class="fa fa-edit i-edit"></i> Edit</a> 
            </td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredTownship.length}} | Total : {{townshiplst.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <!-- City Dialog -->
    <script type="text/ng-template" id="townshipdialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-map-marker"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.cityname.$invalid}">
                      <label class="control-label col-md-5" for="cityname">City:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="cityname" ng-model="selcity" ng-options="c.city_name for c in citylst"></select>
                      </div>
                  </div>
                  
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.townshipname.$invalid}">
                      <label class="control-label col-md-5" for="townshipname">Township Name:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="townshipname" ng-focus="true" ng-model="townshipname" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="savetownship()" ng-disabled="dataForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> Save</button>       
        </div>
    </script>
    <!-- End of City Dialog -->

</div>