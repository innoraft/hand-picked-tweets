//var getlabel = location.search.split('label=')[1];

var module = angular.module("route1", ['ngRoute']);

    module.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
                    when('/', {templateUrl: 'mock-1-with-angular.html'}).
                    when('/label/:param', {templateUrl: 'mock-1-with-angular-tweetpage.html',controller: 'RouteController'}).
                    otherwise({redirectTo: '/'});
        }]);

    module.controller("RouteController",['$scope','$routeParams','$http', function($scope, $routeParams,$http) {
        //    alert($routeParams.param);
            $scope.labelsend = $routeParams.param;
            var x=$routeParams.param;
            $http.get('host.php?flag=fetch').success (function(data1){
              $scope.tweets=data1[x];
                //$scope.gtlabel=getlabel; 
               console.log(data1[x]);
              
            });
            
            
    }]);

 module.controller('MainCtrl', ['$scope','$http', function ($scope,$http) {
        
        $http.get('host.php?flag=labelretrieval').success (function(data){
            //labels stores the JSON data which carries the Label details with ID
                
        $scope.labels=data; 
        });

    }]);
module.filter('unsafe', function($sce) {

    return function(val) {

            return $sce.trustAsHtml(val);

    };
});

/*myApp.directive('myPostRepeatDirective', function() {
  return function(scope, element, attrs) {
    if (scope.$last){
      // iteration is complete, do whatever post-processing
      // is necessary
        // SOME FUNCTION
        //BUT Y U NO WORK
    }
  };
});*/