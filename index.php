<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>Long Pooling</title>
	<script src="js/angular.min.js"></script>
</head>
<body ng-app="app" ng-controller="ctrl">
	<div ng-repeat="m in messages">
		{{m.id}} - {{m.title}}
	</div>
	<script>
		var app = angular.module('app',[]);
		app.controller('ctrl', function($scope, $http){
			$scope.messages = [];
			$scope.show = function(id)
			{
				var data = {'id': id};			
				$http.post('long.php', data)
					.then(function(result){
						angular.forEach(result.data, function(value, key){
							$scope.messages.push(value);
						});
						$scope.show($scope.messages[$scope.messages.length - 1].id);
					});
			}
			$scope.show(0);
		});
	</script>
</body>
</html>