var getlabel = location.search.split('label=')[1];

var myApp = angular.module('labelpage', []);
// this controller brings the JSON data from a specified paths. 
myApp.controller('MainCtrl', ['$scope','$http', function ($scope,$http) {
        
        $http.get('host.php?flag=labelretrieval').success (function(data){
            //labels stores the JSON data which carries the Label details with ID
                $scope.labels=data;             
             //JSON format is {"1":"humour","2": "business"..};
            
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

var myApp = angular.module('tweetpage', []);
// this controller brings the JSON data from a specified paths. 

myApp.directive('onLastRepeat', function() {
        return function(scope, element, attrs) {
            if (scope.$last) setTimeout(function(){
                scope.$emit('onRepeatLast', element, attrs);
            }, 1);
        };
    });

myApp.controller('MainCtrl', ['$scope','$http', function ($scope,$http) {
    
        $scope.$on('onRepeatLast', function(scope, element, attrs){
             myApp.twttr.widgets.load();
            console.log("hi");
      });
    
        $http.get('host.php?flag=fetch').success (function(data){
            console.trace();
                $scope.tweets=data;
				$scope.gtlabel=getlabel; 
        });   
}]);

myApp.filter('unsafe', function($sce) {

    return function(val) {

        return $sce.trustAsHtml(val);

    };
});