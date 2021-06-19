
/**
 * Binds a TinyMCE widget to <textarea> elements.
 */
angular.module('ui.tinymce', [])
    .value('uiTinymceConfig', {})
    .directive('uiTinymce', ['uiTinymceConfig', function(uiTinymceConfig) {
    uiTinymceConfig = uiTinymceConfig || {};
    var generatedIds = 0;
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ngModel) {
            var expression, options, tinyInstance;
            // generate an ID if not present
            if (!attrs.id) {
                attrs.$set('id', 'uiTinymce' + generatedIds++);
            }
            options = {
                // Update model when calling setContent (such as from the source editor popup)
                setup: function(ed) {
                    ed.on('init', function(args) {
                        ngModel.$render();
                    });
                    // Update model on button click
                    ed.on('ExecCommand', function(e) {
                        ed.save();
                        ngModel.$setViewValue(elm.val());
                        if (!scope.$$phase) {
                            scope.$apply();
                        }
                    });
                    // Update model on keypress
                    ed.on('KeyUp', function(e) {
                        console.log(ed.isDirty());
                        ed.save();
                        ngModel.$setViewValue(elm.val());
                        if (!scope.$$phase) {
                            scope.$apply();
                        }
                    });
                },
                mode: 'exact',

                elements: attrs.id,
                width:"900",
				height:"400",
	           
	            
	            plugins: [
	                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	                "searchreplace wordcount visualblocks visualchars code",
	                "insertdatetime media nonbreaking save table contextmenu directionality",
	                "emoticons template paste textcolor colorpicker textpattern"
	            ],
	            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	            toolbar2: "print preview | forecolor backcolor emoticons | template",
	            image_advtab: true,
	            file_picker_callback: function(callback, value, meta) {
	            if (meta.filetype == 'image') {
	                $('#upload').trigger('click');
	                $('#upload').on('change', function() {
	                var file = this.files[0];
	                var reader = new FileReader();
	                reader.onload = function(e) {
	                    callback(e.target.result, {
	                    alt: ''
	                    });
	                };
	                reader.readAsDataURL(file);
	                });
	            }
	            },
	            templates: [
				  {title: 'Specification', description: 'Notice', url: "/templates/specification.html"}
				  
				  ]
            };
            if (attrs.uiTinymce) {
                expression = scope.$eval(attrs.uiTinymce);
            } else {
                expression = {};
            }
            angular.extend(options, uiTinymceConfig, expression);
            setTimeout(function() {
                tinymce.init(options);
            });


            ngModel.$render = function() {
                if (!tinyInstance) {
                    tinyInstance = tinymce.get(attrs.id);
                }
                if (tinyInstance) {
                    tinyInstance.setContent(ngModel.$viewValue || '');
                }
            };
        }
    };
}]); 


var k = angular.module('ProductApp',['ui.tinymce']);
k.controller('ProductController',function($scope,$http){
	$scope.brands;
	$scope.solutions;
	$scope.brandlevels=[]
	$scope.solutionlevels=[]	
	$scope.brandselect=[]
	$scope.solutionselect=[]
	$scope.bnotleaf=true;
	$scope.snotleaf=true;	
	$scope.product=[];
	$scope.features=[];
	$scope.specification;
	$scope.purpose;
	$scope.faqs=[];
	$scope.drivers=[];
	$scope.newdrivers=[];
	$scope.images=[];
	$scope.getBrandsAndSolutions=function(){
		$http({ method: "GET", url: "/admin/products/getbrandsandsolutions" }).then(function success(response) {
			 $scope.brands=response.data.brands;
			 $scope.solutions=response.data.solutions;
			 var temp={'level':0,'model':'brand0',vals:[]}
			 for(var i=0;i<$scope.brands.length;i++)
			 {
			 	if($scope.brands[i].parent_id==0)
			 		temp['vals'].push($scope.brands[i]);
			 }
			 $scope.brandlevels.push(temp);
			 $scope.brandselect.push(0)
			 var temp={'level':0,vals:[],'model':'solution0'}
			 
			 for(var i=0;i<$scope.solutions.length;i++)
			 {
			 	if($scope.solutions[i].parent_id==0)
			 		temp['vals'].push($scope.solutions[i]);
			 }
			 $scope.solutionlevels.push(temp);
			 $scope.solutionselect.push(0)
			 
		},function error(response){
			alert("wrong");
		});
	}

	$scope.brandchange=function(level){
		// console.log("asdasd",level);
		var pid=$('#brandselect'+level).val();
		console.log(pid)
		for(var i=0;i<$scope.brandlevels.length;i++){
			console.log(i,$scope.brandlevels.length)
			if($scope.brandlevels[i]['level']>level)
			{
				$scope.brandlevels.splice(i,1);
				i=i-1
			}
			
		}
		var found=false;
		for(var i=0;i<$scope.brands.length;i++)
		{
		 	if($scope.brands[i].parent_id==pid)
		 		found=true;
		}
		if(found==true)
		{
			var temp={'level':level+1,vals:[],'model':'brand'+(level+1).toString()}
			 for(var i=0;i<$scope.brands.length;i++)
			 {
			 	if($scope.brands[i].parent_id==pid)
			 		temp['vals'].push($scope.brands[i]);
			 }
			 $scope.brandlevels.push(temp);
			 $scope.brandselect.push(level+1)
		}
		$scope.bnotleaf=found;
		 
	}
	$scope.basicSubmitDisabled=function()
	{
		if($scope.bnotleaf==false && $scope.snotleaf==false)
			return false
		else
			return true
	}
	$scope.solutionchange=function(level){
		console.log("asdasd",level);
		var pid=$('#solutionselect'+level).val();
		for(var i=0;i<$scope.solutionlevels.length;i++){
			console.log(i,$scope.solutionlevels.length)
			if($scope.solutionlevels[i]['level']>level)
			{
				$scope.solutionlevels.splice(i,1);
				i=i-1
			}
			
		}
		var found=false;
		for(var i=0;i<$scope.solutions.length;i++)
		{
		 	if($scope.solutions[i].parent_id==pid)
		 		found=true;
		}
		if(found==true)
		{
			var temp={'level':level+1,vals:[],'model':'solution'+(level+1).toString()}
			 for(var i=0;i<$scope.solutions.length;i++)
			 {
			 	if($scope.solutions[i].parent_id==pid)
			 		temp['vals'].push($scope.solutions[i]);
			 }
			 $scope.solutionlevels.push(temp);
				
		}
		$scope.snotleaf=found;
	}
	
	$scope.basicSubmit=function(){
		var formData = new FormData();
		var brandid=$scope.brandlevels[$scope.brandlevels.length-1]['model'];
		var solutionid=$scope.solutionlevels[$scope.solutionlevels.length-1]['model'];
		formData.append('brochure',$scope.brochure);
		formData.append('name',$scope.product.name);
		formData.append('description',$scope.product.description);
		formData.append('brand_id',brandid);
		formData.append('solution_id',solutionid);
		formData.append('priority',$('#priority').val());
		console.log(brandid,solutionid)
		$http.post('/admin/products/addbasics', formData, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}}).then(function success(response) {
			swal(
				  'Success!',
				  'Added Successfully!',
				  'success'
				)
			var id=response.data.toString();
			console.log(id)
			document.location.href="/admin/products"+"/"+id+"/edit";
		},function error(response){
			var errors='<ul>';
			console.log(response.data.errors)
			for(var e in response.data.errors)
			{
				errors+='<li>'+response.data.errors[e]+'</li>';
			}
			errors+='</ul>'
			swal({
				  title: '<u>Error!!!</u>',
				  type: 'warning',
				  html:errors,
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Okay',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				 
			})
		})
	}
	$scope.basicEditSubmit=function(){
		var formData = new FormData();
		var brandid=$scope.brandlevels[$scope.brandlevels.length-1]['model'];
		var solutionid=$scope.solutionlevels[$scope.solutionlevels.length-1]['model'];
		formData.append('brochure',$scope.brochure);
		formData.append('name',$scope.product.name);
		formData.append('description',$scope.product.description);
		formData.append('brand_id',brandid);
		formData.append('solution_id',solutionid);
		formData.append('id',$scope.product.id);
		formData.append('priority',$('#priority').val());
		console.log($scope.product.name);
		// var parameter = JSON.stringify({ id: _category.id, name: _category.name, parent_id: _category.parent_id, description: _category.description });
		$http.post('/admin/products/editbasics', formData, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}}).then(function success(response) {
			swal(
				  'Success!',
				  'Added Successfully!',
				  'success'
				)
			var id=response.data.toString();
			console.log(id)
			document.location.href="/admin/products"+"/"+id+"/edit";
		},function error(response){
			var errors='<ul>';
			console.log(response.data.errors)
			for(var e in response.data.errors)
			{
				errors+='<li>'+response.data.errors[e]+'</li>';
			}
			errors+='</ul>'
			swal({
				  title: '<u>Error!!!</u>',
				  type: 'warning',
				  html:errors,
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Okay',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				 
			})
            
        });
	}
	$scope.editinit=function(){
		$scope.getBrandsAndSolutions();
		var product=JSON.parse($('#product').val());
		// console.log(product)
		// console.log(product['name'])
		$scope.product['name']=product.name;
		$scope.product['description']=product.description;
		$scope.product['id']=product.id;
		$scope.features=product.features;
		$scope.specification=product.specification;
		$scope.purpose=product.purpose;
		$scope.faqs=product.faqs;
		$scope.drivers=product.drivers;
		$scope.images=product.productimages;
		console.log(product.productimages);
		console.log(product.features);
		// console.log($scope.features);
	}
	$scope.addFeature=function(){
		var len=$scope.features.length;	
		var	 temp={title:"",description:"",product_id:$scope.product['id'],created_at:"",updated_at:""}
		$scope.features.push(temp);

	}
	$scope.removeFeature=function(f){
		// console.log(f)
		$scope.features.splice($scope.features.indexOf(f),1);
	}
	$scope.featureSubmit=function(){
		console.log("Asdasd")
		$http({ method: "POST", url: "/admin/products/savefeatures", data:{'features':$scope.features,'id':$scope.product['id']} }).then(function success(response) {
			console.log(response.data);
			swal(
				  'Success!',
				  'Saved Successfully!',
				  'success'
				)
			$scope.features=response.data;

		},function error(response){
			var errors='<ul>';
			console.log(response.data.errors)
			for(var e in response.data.errors)
			{
				errors+='<li>'+response.data.errors[e]+'</li>';
			}
			errors+='</ul>'
			swal({
				  title: '<u>Error!!!</u>',
				  type: 'warning',
				  html:errors,
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Okay',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				 
			})
		});
	}
	$scope.saveSpecification=function(){
		$http({ method: "POST", url: "/admin/products/savespecification", data:{'specification':$scope.specification,'id':$scope.product['id']} }).then(function success(response) {
			console.log(response.data);
			swal(
				  'Success!',
				  'Saved Successfully!',
				  'success'
				)
			$scope.specification=response.data;

		},function error(response){
			alert("wrong");
			location.reload();
		});

	}
	$scope.savePurpose=function(){
		$http({ method: "POST", url: "/admin/products/savepurpose", data:{'purpose':$scope.purpose,'id':$scope.product['id']} }).then(function success(response) {
			console.log(response.data);
			swal(
				  'Success!',
				  'Saved Successfully!',
				  'success'
				)
			$scope.purpose=response.data;

		},function error(response){
			alert("wrong");
			location.reload();
		});
	}
	$scope.addFaq=function(){
		var len=$scope.faqs.length;	
		var	 temp={question:"",answer:"",product_id:$scope.product['id'],created_at:"",updated_at:""}
		$scope.faqs.push(temp);
	}
	$scope.removeFaq=function(f){
		$scope.faqs.splice($scope.faqs.indexOf(f),1);
	}
	$scope.faqSubmit=function(){
		console.log("Asdasd")
		$http({ method: "POST", url: "/admin/products/savefaqs", data:{'faqs':$scope.faqs,'id':$scope.product['id']} }).then(function success(response) {
			console.log(response.data);
			swal(
				  'Success!',
				  'Saved Successfully!',
				  'success'
				)
			$scope.faqs=response.data;

		},function error(response){
			var errors='<ul>';
			console.log(response.data.errors)
			for(var e in response.data.errors)
			{
				errors+='<li>'+response.data.errors[e]+'</li>';
			}
			errors+='</ul>'
			console.log(errors);
			swal({
				  title: '<u>Error!!!</u>',
				  type: 'warning',
				  html:errors,
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Okay',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				 
			})
			// console.log(response);
			// location.reload();
		});
	}
	$scope.addDriver=function(d){
		var formData = new FormData();
		formData.append('title',d.title);
		formData.append('file',d.file);
		formData.append('id',$scope.product['id']);
		// var parameter = JSON.stringify({ id: _category.id, name: _category.name, parent_id: _category.parent_id, description: _category.description });
		$http.post('/admin/products/adddriver', formData, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}}).then(function success(response) {
			swal(
				  'Success!',
				  'Added Successfully!',
				  'success'
				)
			$scope.drivers=response.data;
			$scope.newdrivers.title="";
			$scope.newdrivers.file="";
			// document.location.href="/admin/products"+"/"+id+"/edit";
		},function error(response){
			var errors='<ul>';
			console.log(response.data.errors)
			for(var e in response.data.errors)
			{
				errors+='<li>'+response.data.errors[e]+'</li>';
			}
			errors+='</ul>'
			console.log(errors);
			swal({
				  title: '<u>Error!!!</u>',
				  type: 'warning',
				  html:errors,
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Okay',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				 
			})
		})	
	}
	$scope.saveDriver=function(d)
	{
		var formData = new FormData();
		formData.append('title',d.title);
		formData.append('file',d.file);
		formData.append('driver_id',d.id);
		// var parameter = JSON.stringify({ id: _category.id, name: _category.name, parent_id: _category.parent_id, description: _category.description });
		$http.post('/admin/products/savedriver', formData, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}}).then(function success(response) {
			swal(
				  'Success!',
				  'Added Successfully!',
				  'success'
				)
			$scope.drivers=response.data;
			// document.location.href="/admin/products"+"/"+id+"/edit";
		},function error(response){
			var errors='<ul>';
			console.log(response.data.errors)
			for(var e in response.data.errors)
			{
				errors+='<li>'+response.data.errors[e]+'</li>';
			}
			errors+='</ul>'
			console.log(errors);
			swal({
				  title: '<u>Error!!!</u>',
				  type: 'warning',
				  html:errors,
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Okay',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				 
			})
		})		
	}
	$scope.removeDriver=function(d)
	{
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
			  	parameter={driver_id: d.id}
						$http.post('/admin/products/removedriver', parameter).then(function (response) {
						$scope.drivers = response.data;
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
	$scope.deleteImage=function(id)
	{
		var parameter={id:id,product_id:$scope.product['id']};
			swal({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then(function (result) {
				
		
		$http.post('/admin/products/removeimage', parameter).then(function (response) {
						$scope.images = response.data;
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

})


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