var app = angular.module('app', ['angular-carousel']);

app.factory('convertTable', ['$q', function($q){
	var defered = $q.defer();
	
	return {
		splitTable: function (data, tableSize) {
			var i =0;
			var li = 0;
			tabF = new Array;
			tabTemp = new Array;
			angular.forEach(data,function(item,index){
				tabTemp[i] = item;
				i++;
				if(i== tableSize && index !=0) {
					tabF[li] = tabTemp;
					li++;
					i = 0;
					tabTemp = new Array;
				}
			});
			if( i!= 0)
				tabF[li] = tabTemp;
			
			defered.resolve(tabF);
			return defered.promise;
			
		}
		
	};
}]);

app.controller('menuController', ['$scope', '$http', 'convertTable', function($scope, $http, convertTable) {
	var fichier = "js/data/links.json";
	$http.get(fichier).success(function(data) {
		
		convertTable.splitTable(data, 6).then(function(tabF){
			$scope.datas = tabF;
		});
	});
}]);