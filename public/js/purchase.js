(function(){
    var app = angular.module('qfarming', [ ]);

    app.controller("SearchItemCtrl", [ '$scope', '$http', function($scope, $http) {
        $scope.items = [ ];
        $http.get('/api/allitem').success(function(data) {
            $scope.items = data;
        });
        // $scope.suppliers = [ ];
        // $http.get('/api/company').success(function(data) {
        //     $scope.suppliers = data;
        // });
        $scope.receivingtemp = [ ];
        $scope.newreceivingtemp = { };
        $http.get('/api/receivingtemp').success(function(data, status, headers, config) {
            $scope.receivingtemp = data;
        });
        $scope.addReceivingTemp = function(item,newreceivingtemp) {
            $http.post('/api/receivingtemp', { item_id: item.id, unit_id:item.base_unit_id }).
            success(function(data, status, headers, config) {
                $scope.receivingtemp.push(data);
                $http.get('/api/receivingtemp').success(function(data) {
                    $scope.receivingtemp = data;
                });
            });
        }
        $scope.updateReceivingTemp = function(newreceivingtemp) {
            $http.put('/api/receivingtemp/' + newreceivingtemp.id, {cost_price:newreceivingtemp.cost_price, selling_price:newreceivingtemp.selling_price,quantity: newreceivingtemp.quantity, discount: newreceivingtemp.discount }).
            success(function(data, status, headers, config) {
            });
        }
        $scope.removeReceivingTemp = function(id) {
            $http.delete('/api/receivingtemp/' + id).
            success(function(data, status, headers, config) {
                $http.get('/api/receivingtemp').success(function(data) {
                    $scope.receivingtemp = data;
                });
            });
        }
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newreceivingtemp){
                total+= parseFloat(newreceivingtemp.cost_price * newreceivingtemp.quantity);
            });
            return total;
        }

        $scope.sumQuantity = function(list) {
            var totalQuantity=0;
            angular.forEach(list , function(newreceivingtemp){
                totalQuantity+= parseFloat(newreceivingtemp.quantity);
            });
            return totalQuantity;
        }

        $scope.sumDiscount = function(list) {
            var totalDiscount=0;
            angular.forEach(list , function(newreceivingtemp){
                totalDiscount+= parseFloat(newreceivingtemp.discount);
            });
            return totalDiscount;
        }

    }]);
})();
