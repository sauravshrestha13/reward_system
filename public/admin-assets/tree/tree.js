var k= angular.module("treeapp",[])
k.controller("TreeController", function ($scope, $http) {
	$scope.categorys;
	$scope.dummy;
	$scope.leafs;
	$scope.itemList;
	$scope.category;
	$scope.item;
	$scope.action;
	$scope.id;
	$scope.pid;
	$scope.page;
	$scope.url_categoryList="/admin/brands/getbrands";
	$scope.url_categoryById="/admin/brands/brandsbyid";
	$scope.url_addCategory="/admin/brands/create";
	$scope.url_editCategory="/admin/brands/edit";
	$scope.url_editCategoryParent="/admin/brands/editParent";
	$scope.url_delete="/admin/brands/delete"
	$scope.url_hasChild="";
	// $scope.init=function(getlist,getbyid,add,edit,delete,getleaf,itemlist,itembyid,additem,deleteItem)
	// {

	// }

	$scope.init=function()
	{
		
	}
	$scope.getCategory = function (text) {
		$scope.page=text;
		$scope.url_categoryList="/admin/"+text+"/get"+text;
		$scope.url_categoryById="/admin/"+text+"/"+text+"byid";
		$scope.url_addCategory="/admin/"+text+"/create";
		$scope.url_editCategory="/admin/"+text+"/edit";
		$scope.url_editCategoryParent="/admin/"+text+"/editParent";
		$scope.url_delete="/admin/"+text+"/delete";
		$scope.url_hasChild="/admin/"+text+"/haschild";
		$http({ method: "GET", url: $scope.url_categoryList }).then(function success(response) {
			$scope.categorys = response.data;
			console.log(response.data)
		},function error(response){
			alert("wrong");
			location.reload();

		});
		// console.log($scope.categorys)
	}
	$scope.select = function (a, id,pid) {
		console.log($scope.page);

		if($scope.page=='brands' && a=="Edit" && pid==0)
		{
			// console.log($scope.page,a,0);
			// $('#category').attr('style','display:none;');
			window.location.href="/admin/brands/editmainbrand"+'/'+id;
		}
		else
		{
			if(a=="Edit")
				$('#category').modal('show');
			if (a == "Details" || a == "Edit") {
				$http({ method: "GET", url: $scope.url_categoryById, params: { id: id } }).then(function success(response) {
					$scope.category = response.data;
					console.log(response.data);
				},function error(response){
					alert("wrong");
					location.reload();
				})
			}

			$scope.action = a;
			$scope.id = id;
			$scope.pid=pid;

		}
	}

	$scope.addCategory = function (_category) {
		_category.id = $scope.categorys.length + 1;
		_category.parent_id = $scope.id;
			var formData = new FormData();
		formData.append("logo",_category.logo);
		formData.append('id',_category.id);
		formData.append('name',_category.name);
		formData.append('parent_id',_category.parent_id);
		formData.append('description',_category.description);
		// console.log($scope.id);
		// var parameter = JSON.stringify({ id: _category.id, name: _category.name, parent_id: _category.parent_id, description: _category.description });
		var hasChild="";
		$http.post($scope.url_hasChild, formData, {
			                  transformRequest: angular.identity,
			                  headers: {'Content-Type': undefined}}).then(function success(response) {
						hasChild = response.data;

						if(hasChild=="hasChild")
						{

							swal({
										  title: 'This Category contains product!!',
										  text: "Products under this category will be transfered to newly created category",
										  type: 'warning',
										  showCancelButton: true,
										  confirmButtonColor: '#3085d6',
										  cancelButtonColor: '#d33',
										  confirmButtonText: 'Yes,do it!'
										}).then((result) => {
										  
										  	console.log("asdasd")
										   $http.post($scope.url_addCategory, formData, {
									                  transformRequest: angular.identity,
									                  headers: {'Content-Type': undefined}}).then(function success(response) {
												$scope.categorys = response.data;
												
												swal(
													  'Success!',
													  'Added Successfully!',
													  'success'
													)
											},function error(response){
												swal(
													  'Oops...',
													  'Something went wrong!',
													  'error'
													)
												location.reload();
											})

										  
										});
						}
						else{
							$scope.categorys=hasChild;
							swal(
								  'Success!',
								  'Added Successfully!',
								  'success'
								)
						}
						
					},function error(response){
						swal(
							  'Oops...',
							  'Something went wrong!',
							  'error'
							)
						location.reload();
					});

		
		
		$scope.dummy = "";

	}
	$scope.editCategory = function (_category) {
			var formData = new FormData();
		formData.append("logo",_category.editlogo);
		formData.append('id',_category.id);
		formData.append('name',_category.name);
		formData.append('parent_id',_category.parent_id);
		formData.append('description',_category.description);
		// var parameter = JSON.stringify({ id: $scope.category.id, name: _category.name, parent_id: $scope.category.parent_id, description: _category.description });
			$http.post($scope.url_editCategory, formData, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}}).then(function success(response) {
			$scope.categorys = response.data;
			swal(
				  'Success!',
				  'Edited Successfully!',
				  'success'
				)
			},function(error){
				swal(
				  'Oops...',
				  'Something went wrong!',
				  'error'
				)
				location.reload();
			})

		
	

	}
	$scope.deleteCategory = function (id) {
		var parameter = JSON.stringify({ id: id });

		console.log($scope.id)
		swal({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then(function (result) {
				
			  	console.log("asd")
						$http.post($scope.url_delete, parameter).then(function (response) {
						$scope.categorys = response.data;
						 swal(
					      'Deleted!',
					      'Your file has been deleted.',
					      'success'
					    )
					},function(error){
						swal(
						  'Oops...',
						  'Something went wrong!',
						  'error'
						)
						location.reload();
					})	  	
			   
			  
			})
		
	}
//Item operation
$scope.getLeaf = function () {
	$http({ method: "GET", url: "/Dictionary/getLeaf"}).success(function (response) {
		$scope.leafs = response;

	})
}
$scope.getList = function () {
	$http({ method: "GET", url: "/Dictionary/itemList" }).success(function (response) {
		$scope.itemList = response;


	})
}

$scope.logo=false;
$scope.selectItem = function (a, id) {
	if (a == "description" || a == "Edit") {
		$http({ method: "GET", url: "/Dictionary/itemById", params: { id: id } }).success(function (response) {
			$scope.item = response;
		location.reload();

			angular.forEach($scope.leafs, function (value, key) {
				if (value.id == $scope.item.id)
					$scope.categoryOfItem = value;
			});
		})



	}
	if(a=="addbrand")
		$scope.logo=true
	else
		$scope.logo=false
	$scope.id = id;
	$scope.action = a;
}
$scope.addItem = function (_item) {
	_item.ItemId = $scope.itemList.length + 1;
	var parameter = JSON.stringify({ ItemId: _item.ItemId, Name: _item.Name, id: _item.id, description: _item.description ,Examples:_item.Examples});
	$http.post("/Dictionary/addItem", parameter).success(function (response) {
		$scope.itemList = response;
	})

}

$scope.editItem = function (_item) {
	debugger;
	var parameter = JSON.stringify({ ItemId: _item.ItemId, Name: _item.Name, id: _item.id, description: _item.description, Examples: _item.Examples });
	$http.post("/Dictionary/editItem", parameter).success(function (response) {
		$scope.itemList = response;
	})

}
$scope.deleteItem = function () {
	var parameter = JSON.stringify({ id: $scope.id });

	$http.post("/Dictionary/deleteItem", parameter).success(function (response) {
		$scope.itemList = response;
	})
}
$scope.brandSubmitDisabled=function(c){
	console.log(c.name);
	if(c.name.length==0)
	return true;
else return false;
}
});


k.directive("fileread", [function () {
    return {
        scope: {
            fileread: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {
                scope.$apply(function () {
                    scope.fileread = changeEvent.target.files[0];
                    // or all selected files:
                    // scope.fileread = changeEvent.target.files;
                });
            });
        }
    }
}]);