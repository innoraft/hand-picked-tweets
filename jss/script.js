var namespace=angular.module("mainModule", []);
  namespace.controller("mainController", ['$scope','$http', function($scope, $http)
        {    
            $http.get('host.php?flag=fetch&label=humour&num=50&tweetid=649723y5986').success (function(data){
                $scope.simpleGetCallResult=data;
                
                //for(var i=0; i<data.Length;i++)
          //      alert(data.Length);
               
                
        });
 
        }]
);
var routeApp=angular.module("route1", ['ngRoute']);
routeApp.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
                    when('/', {templateUrl: 'mock-1-with-angular.html'});
                    
        }]);
    

