var myApp = angular.module('labelpage', []);
// this controller brings the JSON data from a specified paths. 
myApp.controller('MainCtrl', ['$scope','$http', function ($scope,$http) {
        
        $http.get('host.php?flag=labelretrieval').success (function(data){
            //labels stores the JSON data which carries the Label details with ID
                $scope.labels=data;
                
             //JSON format is {"1":"humour","2": "business"..};
         //   var i=1; 
         //   alert(data[i]);
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

var myApp = angular.module('tweetpage', []);
// this controller brings the JSON data from a specified paths. 
myApp.controller('MainCtrl', ['$scope','$http', function ($scope,$http) {
        
        $http.get('host.php?flag=fetch').success (function(data){

                $scope.tweets=data;               
                  
        });   
}]);

