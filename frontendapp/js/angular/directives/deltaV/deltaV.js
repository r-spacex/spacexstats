(function() {
    var app = angular.module('app');

    app.directive('deltaV', function() {
        return {
            restrict: 'E',
            scope: {
                deltaV: '=ngModel'
            },
            link: function($scope, element, attributes) {

                $scope.$watch("deltaV", function(objects) {
                    if (typeof objects !== 'undefined') {
                        $scope.newValue = 0;

                        if (Array.isArray(objects)) {
                            objects.forEach(function(object) {
                                $scope.newValue += $scope.calculate(object);
                            });
                        } else {
                            $scope.newValue = $scope.calculate(objects);
                        }

                        $scope.calculatedValue = $scope.newValue;
                    }
                }, true);

                $scope.calculate = function(object) {
                    var internalValue = 0;
                    Object.getOwnPropertyNames(object).forEach(function(key) {
                        if (key == 'tags') {
                            internalValue += object[key].length;
                        }
                    });
                    return internalValue;
                };

                $scope.calculatedValue = 0;
            },
            templateUrl: '/js/templates/deltaV.html'
        }
    });
})();