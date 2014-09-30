//var getlabel = location.search.split('label=')[1];

var module = angular.module("route1", ['ngRoute']);

    module.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
                    when('/', {templateUrl: 'mock-1-with-angular.html'}).
                    when('/label/:param', {templateUrl: 'mock-1-with-angular-tweetpage.html',controller: 'RouteController'}).
                    otherwise({redirectTo: '/'});
        }]);

    module.controller("RouteController",['$scope','$routeParams','$http','$rootScope', function($scope,$routeParams,$http,$rootScope) {
        //    alert($routeParams.param);
        $op='on';
            $scope.labelsend = $routeParams.param;
            //$scope.labelsend = data;
            $scope.gtlabel=$rootScope.labels;
            
            console.log($rootScope.labels);
            $http.get('host.php?flag=fetch').success (function(tweetdata){
              $scope.tweets=tweetdata;
            });
            
            
    }]);

    // A directive that runs the twitter widget loading code.
    // Recommended to be used with ng-repeat or ng-show that renders embed tweet HTML
    module.directive('ngTweetsRender', function($timeout) {
      return function(scope, element, attrs) {
        // We need to the use $timeout so the executing of this is queued in the same $digest cycle
        // Refer - http://www.sitepoint.com/understanding-angulars-apply-digest/
        $timeout(function(){
            window.twttr.widgets.load();
        });
      };
    });

 module.controller('MainCtrl', ['$scope','$http', '$timeout','$rootScope', function ($scope,$http, $timeout, $rootScope) {
        
        $http.get('host.php?flag=labelretrieval').success (function(data){
            //labels stores the JSON data which carries the Label details with ID
                
        $rootScope.labels=data; 
        
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