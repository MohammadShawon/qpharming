(function(){
    var app = angular.module('qfarming', [ ]);

    app.controller("SearchItemCtrl", [ '$scope', '$http', function($scope, $http) {
        $scope.items = [ ];
        $http.get('/api/item').success(function(data) {
            $scope.items = data;
            console.log(data);
        });
        // $scope.customers = [ ];
        // $http.get('api/customer').success(function(data) {
        //     $scope.customers = data;
        // });
        // $scope.currentDue = [ ];
        // $scope.customerDue = function (id) {
        //     $http.get('api/currentDue/' + id).success(function(data) {
        //         $scope.currentDue = data;
        //     });
        // };

        $scope.message = [ ];
        $scope.saletemp = [ ];
        $scope.newsaletemp = { };
        $http.get('/api/saletemp').success(function(data, status, headers, config) {
            $scope.saletemp = data;
        });
        $scope.addSaleTemp = function(item, newsaletemp) {
            $http.post('/api/saletemp', { item_id: item.id, unit_id:item.base_unit_id }).
            success(function(data, status, headers, config) {
                $scope.message.push(data);
                $scope.saletemp.push(data);
                $http.get('/api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                });
            });
        }
        $scope.updateSaleTemp = function(newsaletemp) {

            $http.put('/api/saletemp/' + newsaletemp.id, {selling_price: newsaletemp.selling_price,discount:newsaletemp.discount, quantity: newsaletemp.quantity, total_selling: newsaletemp.selling_price * newsaletemp.quantity - newsaletemp.quantity * newsaletemp.discount }).
            success(function(data, status, headers, config) {
                // location.reload();
                //Quantity exceed reload
                if (data === '')
                {
                    $http.get('/api/saletemp').success(function(data) {
                        $scope.saletemp = data;
                    });
                }
                console.log(data);
                //or this

            });
        }
        $scope.removeSaleTemp = function(id) {
            $http.delete('/api/saletemp/' + id).
            success(function(data, status, headers, config) {
                $http.get('/api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                });
            });
        }
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newsaletemp){
                total+= parseFloat(newsaletemp.selling_price * newsaletemp.quantity - (newsaletemp.quantity * newsaletemp.discount));
            });
            return total;
        }
        $scope.sumQuantity = function(list) {
            var totalQuantity=0;
            angular.forEach(list , function(newsaletemp){
                totalQuantity+= parseFloat(newsaletemp.quantity);
            });
            return totalQuantity;
        }

        $scope.sumDiscount = function(list) {
            var totalDiscount=0;
            angular.forEach(list , function(newsaletemp){
                totalDiscount+= parseFloat(newsaletemp.discount);
            });
            return totalDiscount;
        }

        //specific word search
        $scope.filterData = function (obj) {
            return anyNameStartsWith(obj.product_name, $scope.searchKeyword);
        };

        function anyNameStartsWith (fullname, search) {

            //validate if name is null or not a string if needed
            if (search === '')
                return true;

            var delimeterRegex = /[ _-]+/;
            //split the fullname into individual names
            var names = fullname.split(delimeterRegex);

            //do any of the names in the array start with the search string
            return names.some(function(name) {
                return name.toLowerCase().indexOf(search.toLowerCase()) === 0;
            });
        }

    }]);
})();
