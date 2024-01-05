app.controller('PageCtrl', function ($scope, $rootScope, $http, $log, form, req) {

    const dd = $rootScope.dataLog;

    $rootScope.chartFilters = {
        clickKey: null,
        fromDate: null,
        toDate: null,
    };

    // let chartObj = null;
    const initChart = (labels, data) => {

        $('.chartBox').html(`<canvas id="dataChart"></canvas>`);
        let ctx = document.getElementById('dataChart').getContext('2d');
        let chartObj = new Chart(ctx, {
            type: 'line',
            data: {
                labels, //: ['Tokyo', 'Mumbai', 'Mexico City', 'Shanghai', 'Sao Paulo', 'New York', 'Karachi', 'Buenos Aires', 'Delhi', 'Moscow'],
                datasets: [{
                    label: 'Clicks', // Name the series
                    data,//: [500, 50, 2424, 14040, 14141, 4111, 4544, 47, 5555, 6811], // Specify the data values array
                    fill: false,
                    borderColor: '#2196f3', // Add custom color border (Line)
                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                    borderWidth: 1, // Specify bar border width
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

    };

    $rootScope.getChartData = () => {
        req.send({
            method: 'post',
            api: $rootScope.routes.show,
            data: $rootScope.chartFilters
        }, res => {
            if (!res.IsSuccess) return;
            const data = res.Data;
            dd(data);
            initChart(data.labels, data.data);
        }, false);
    };


    $rootScope.downloadChart = () => {
        let canvas = document.getElementById('dataChart');
        let anchor = document.createElement('a');
        anchor.href = canvas.toDataURL('image/png');
        anchor.download = Date.now()+'.png';
        anchor.click();
    };



    // Init call
    $rootScope.getViewData(() => {
        // Call Back...
        let titleName = $rootScope.viewData.clickKey.replace('-', ' ');
        $rootScope.titleS = titleName;
        $rootScope.titleP = titleName;

        $rootScope.chartFilters.clickKey = $rootScope.viewData.clickKey || '';
        $rootScope.chartFilters.userId = $rootScope.viewData.userId || '';
        $rootScope.getChartData();


    });

});
