var myApp = angular.module('labelpage', []);

myApp.controller('MainCtrl', ['$scope', function ($scope) {
    
	$scope.labels = {};
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
    
}]);
