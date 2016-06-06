		/**************************** Township List Controller ****************************/
app.controller("township_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Township_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	gettownshiplist();

	function gettownshiplist(){
		loadData(serviceurl,'gettownshiplist','').success(function(data){
	    	 $scope.townshiplst=data;
	    	 // console.log(data);
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.townshiplst.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredTownship = $scope.townshiplst.slice(begin, end);     
		});
	}
	$scope.gettownshiplist=gettownshiplist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.townshiplst.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredTownship = $scope.townshiplst.slice(begin, end);    
	};

	$scope.finddata=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		gettownshiplist();
		    return;
		   }

		   $scope.filteredTownship=$scope.townshiplst; 
		}
    }

	$scope.opentownshipdialog = function (size) { 	
		$scope.cedit=false;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'townshipdialog',
	      controller: 'TownshipModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};	

	$scope.opentownshipeditdialog = function (c,size) { 	
	    $scope.cedit=true;
	    $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'townshipdialog',
	      controller: 'TownshipModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	}; 	
});

		/**************************** Township Modal Controller ****************************/
app.controller("TownshipModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Township_ctrl";

	if(scope.cedit==true){
		$scope.townshipname=scope.editdata.township_name;
		$scope.title="Township Editing";
	}
	else{
		$scope.title="Township Registration";
	}

	loadData(serviceurl,"getcitylist",null).success(function(data){
		$scope.citylst=data;
		if(scope.cedit==true){
			angular.forEach($scope.citylst,function(val,key){
				if(val.city_id==scope.editdata.city_id){
					$scope.selcity=val;
				}
			});
		}
		else{
			$scope.selcity=data[0];			
		}
	});

	$scope.savetownship=function(){
		var record = {};
		record.cityid=$scope.selcity.city_id;
		record.townshipname = $scope.townshipname;
		if(scope.cedit==false){
			loadData(serviceurl,"savetownship",record).success(function(data){	
				if(data.success==true){
					toastr.success("Township Registered Successfully!");
					$modalInstance.close();
					scope.gettownshiplist();
				}
			});		
		}
		else{
			record.townshipid = scope.editdata.township_id;
			// console.log($scope.course);
			loadData(serviceurl,"updatetownship",record).success(function(data){	
				if(data.success==true){
					toastr.success("Township Updated Successfully!");
					$modalInstance.close();
					scope.gettownshiplist();
				}
			});			
		}
	}

	$scope.formenter=function(event){
		if(event.keyCode==13){
			if($scope.dataForm.$invalid==false){
				$scope.savetownship();
			}
		}
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }	
});
