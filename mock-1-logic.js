var myApp = angular.module('labelpage', []);

myApp.controller('MainCtrl', ['$scope','$http', function ($scope,$http) {
        
        $http.get('host.php?flag=newlabel').success (function(data){
                $scope.labels=data;
                alert(data);
                //for(var i=0; i<data.Length;i++)
          //      alert(data.Length);
               
                
        });
    
/*	$scope.labels = {};
    $scope.labels = {
      "label": 
		[
			{
				"name":"humour"
			},
			{
				"name":"business"
			},
			{
				"name":"food"
			}
		]
    };
*/    
}]);
