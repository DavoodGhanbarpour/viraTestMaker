@extends('base')
    @section('content')
    <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Sales</div>
                <div class="ms-auto lh-1">
                  <div class="dropdown">
                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item active" href="#">Last 7 days</a>
                      <a class="dropdown-item" href="#">Last 30 days</a>
                      <a class="dropdown-item" href="#">Last 3 months</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="h1 mb-3">75%</div>
              <div class="d-flex mb-2">
                <div>Conversion rate</div>
                <div class="ms-auto">
                  <span class="text-green d-inline-flex align-items-center lh-1">
                    7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>
                  </span>
                </div>
              </div>
              <div class="progress progress-sm">
                <div class="progress-bar bg-blue" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                  <span class="visually-hidden">75% Complete</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Revenue</div>
                <div class="ms-auto lh-1">
                  <div class="dropdown">
                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item active" href="#">Last 7 days</a>
                      <a class="dropdown-item" href="#">Last 30 days</a>
                      <a class="dropdown-item" href="#">Last 3 months</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-baseline">
                <div class="h1 mb-0 me-2">$4,300</div>
                <div class="me-auto">
                  <span class="text-green d-inline-flex align-items-center lh-1">
                    8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>
                  </span>
                </div>
              </div>
            </div>
            <div id="chart-revenue-bg" class="chart-sm" style="min-height: 40px;"><div id="apexcharts6m5a2g1" class="apexcharts-canvas apexcharts6m5a2g1 apexcharts-theme-light" style="width: 304px; height: 40px;"><svg id="SvgjsSvg2662" width="304" height="40" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent none repeat scroll 0% 0%;"><g id="SvgjsG2664" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2663"><clipPath id="gridRectMask6m5a2g1"><rect id="SvgjsRect2700" width="310" height="42" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask6m5a2g1"></clipPath><clipPath id="nonForecastMask6m5a2g1"></clipPath><clipPath id="gridRectMarkerMask6m5a2g1"><rect id="SvgjsRect2701" width="308" height="44" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><line id="SvgjsLine2669" x1="0" y1="0" x2="0" y2="40" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="40" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG2708" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2709" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG2717" class="apexcharts-grid"><g id="SvgjsG2718" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine2720" x1="0" y1="0" x2="304" y2="0" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2721" x1="0" y1="8" x2="304" y2="8" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2722" x1="0" y1="16" x2="304" y2="16" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2723" x1="0" y1="24" x2="304" y2="24" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2724" x1="0" y1="32" x2="304" y2="32" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2725" x1="0" y1="40" x2="304" y2="40" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line></g><g id="SvgjsG2719" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine2727" x1="0" y1="40" x2="304" y2="40" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine2726" x1="0" y1="1" x2="0" y2="40" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG2702" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG2703" class="apexcharts-series" seriesName="Profits" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2706" d="M 0 40L 0 25.2C 3.668965517241379 25.2 6.813793103448276 26 10.482758620689655 26C 14.151724137931033 26 17.29655172413793 22.4 20.96551724137931 22.4C 24.63448275862069 22.4 27.779310344827586 28.8 31.448275862068964 28.8C 35.11724137931034 28.8 38.26206896551724 25.6 41.93103448275862 25.6C 45.6 25.6 48.744827586206895 30.4 52.41379310344828 30.4C 56.08275862068965 30.4 59.227586206896554 14 62.89655172413793 14C 66.56551724137931 14 69.71034482758621 27.6 73.37931034482759 27.6C 77.04827586206896 27.6 80.19310344827586 25.2 83.86206896551724 25.2C 87.53103448275861 25.2 90.67586206896551 24.4 94.34482758620689 24.4C 98.01379310344828 24.4 101.15862068965517 15.2 104.82758620689656 15.2C 108.49655172413793 15.2 111.64137931034483 19.6 115.3103448275862 19.6C 118.97931034482758 19.6 122.12413793103448 26 125.79310344827586 26C 129.46206896551723 26 132.60689655172413 23.6 136.27586206896552 23.6C 139.9448275862069 23.6 143.08965517241379 26 146.75862068965517 26C 150.42758620689656 26 153.57241379310344 29.2 157.24137931034483 29.2C 160.91034482758621 29.2 164.0551724137931 2.799999999999997 167.72413793103448 2.799999999999997C 171.39310344827587 2.799999999999997 174.53793103448274 18.8 178.20689655172413 18.8C 181.87586206896552 18.8 185.0206896551724 15.600000000000001 188.68965517241378 15.600000000000001C 192.35862068965517 15.600000000000001 195.50344827586207 29.2 199.17241379310346 29.2C 202.84137931034485 29.2 205.98620689655172 18.4 209.6551724137931 18.4C 213.3241379310345 18.4 216.46896551724137 22.8 220.13793103448276 22.8C 223.80689655172415 22.8 226.95172413793102 32.4 230.6206896551724 32.4C 234.2896551724138 32.4 237.43448275862067 21.6 241.10344827586206 21.6C 244.77241379310345 21.6 247.91724137931033 24.4 251.58620689655172 24.4C 255.2551724137931 24.4 258.40000000000003 15.2 262.0689655172414 15.2C 265.73793103448276 15.2 268.8827586206897 19.6 272.55172413793105 19.6C 276.2206896551724 19.6 279.36551724137934 26 283.0344827586207 26C 286.70344827586206 26 289.848275862069 23.6 293.51724137931035 23.6C 297.1862068965517 23.6 300.33103448275864 13.2 304 13.2C 304 13.2 304 13.2 304 40M 304 13.2z" fill="rgba(32,107,196,0.16)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask6m5a2g1)" pathTo="M 0 40L 0 25.2C 3.668965517241379 25.2 6.813793103448276 26 10.482758620689655 26C 14.151724137931033 26 17.29655172413793 22.4 20.96551724137931 22.4C 24.63448275862069 22.4 27.779310344827586 28.8 31.448275862068964 28.8C 35.11724137931034 28.8 38.26206896551724 25.6 41.93103448275862 25.6C 45.6 25.6 48.744827586206895 30.4 52.41379310344828 30.4C 56.08275862068965 30.4 59.227586206896554 14 62.89655172413793 14C 66.56551724137931 14 69.71034482758621 27.6 73.37931034482759 27.6C 77.04827586206896 27.6 80.19310344827586 25.2 83.86206896551724 25.2C 87.53103448275861 25.2 90.67586206896551 24.4 94.34482758620689 24.4C 98.01379310344828 24.4 101.15862068965517 15.2 104.82758620689656 15.2C 108.49655172413793 15.2 111.64137931034483 19.6 115.3103448275862 19.6C 118.97931034482758 19.6 122.12413793103448 26 125.79310344827586 26C 129.46206896551723 26 132.60689655172413 23.6 136.27586206896552 23.6C 139.9448275862069 23.6 143.08965517241379 26 146.75862068965517 26C 150.42758620689656 26 153.57241379310344 29.2 157.24137931034483 29.2C 160.91034482758621 29.2 164.0551724137931 2.799999999999997 167.72413793103448 2.799999999999997C 171.39310344827587 2.799999999999997 174.53793103448274 18.8 178.20689655172413 18.8C 181.87586206896552 18.8 185.0206896551724 15.600000000000001 188.68965517241378 15.600000000000001C 192.35862068965517 15.600000000000001 195.50344827586207 29.2 199.17241379310346 29.2C 202.84137931034485 29.2 205.98620689655172 18.4 209.6551724137931 18.4C 213.3241379310345 18.4 216.46896551724137 22.8 220.13793103448276 22.8C 223.80689655172415 22.8 226.95172413793102 32.4 230.6206896551724 32.4C 234.2896551724138 32.4 237.43448275862067 21.6 241.10344827586206 21.6C 244.77241379310345 21.6 247.91724137931033 24.4 251.58620689655172 24.4C 255.2551724137931 24.4 258.40000000000003 15.2 262.0689655172414 15.2C 265.73793103448276 15.2 268.8827586206897 19.6 272.55172413793105 19.6C 276.2206896551724 19.6 279.36551724137934 26 283.0344827586207 26C 286.70344827586206 26 289.848275862069 23.6 293.51724137931035 23.6C 297.1862068965517 23.6 300.33103448275864 13.2 304 13.2C 304 13.2 304 13.2 304 40M 304 13.2z" pathFrom="M -1 40L -1 40L 10.482758620689655 40L 20.96551724137931 40L 31.448275862068964 40L 41.93103448275862 40L 52.41379310344828 40L 62.89655172413793 40L 73.37931034482759 40L 83.86206896551724 40L 94.34482758620689 40L 104.82758620689656 40L 115.3103448275862 40L 125.79310344827586 40L 136.27586206896552 40L 146.75862068965517 40L 157.24137931034483 40L 167.72413793103448 40L 178.20689655172413 40L 188.68965517241378 40L 199.17241379310346 40L 209.6551724137931 40L 220.13793103448276 40L 230.6206896551724 40L 241.10344827586206 40L 251.58620689655172 40L 262.0689655172414 40L 272.55172413793105 40L 283.0344827586207 40L 293.51724137931035 40L 304 40"></path><path id="SvgjsPath2707" d="M 0 25.2C 3.668965517241379 25.2 6.813793103448276 26 10.482758620689655 26C 14.151724137931033 26 17.29655172413793 22.4 20.96551724137931 22.4C 24.63448275862069 22.4 27.779310344827586 28.8 31.448275862068964 28.8C 35.11724137931034 28.8 38.26206896551724 25.6 41.93103448275862 25.6C 45.6 25.6 48.744827586206895 30.4 52.41379310344828 30.4C 56.08275862068965 30.4 59.227586206896554 14 62.89655172413793 14C 66.56551724137931 14 69.71034482758621 27.6 73.37931034482759 27.6C 77.04827586206896 27.6 80.19310344827586 25.2 83.86206896551724 25.2C 87.53103448275861 25.2 90.67586206896551 24.4 94.34482758620689 24.4C 98.01379310344828 24.4 101.15862068965517 15.2 104.82758620689656 15.2C 108.49655172413793 15.2 111.64137931034483 19.6 115.3103448275862 19.6C 118.97931034482758 19.6 122.12413793103448 26 125.79310344827586 26C 129.46206896551723 26 132.60689655172413 23.6 136.27586206896552 23.6C 139.9448275862069 23.6 143.08965517241379 26 146.75862068965517 26C 150.42758620689656 26 153.57241379310344 29.2 157.24137931034483 29.2C 160.91034482758621 29.2 164.0551724137931 2.799999999999997 167.72413793103448 2.799999999999997C 171.39310344827587 2.799999999999997 174.53793103448274 18.8 178.20689655172413 18.8C 181.87586206896552 18.8 185.0206896551724 15.600000000000001 188.68965517241378 15.600000000000001C 192.35862068965517 15.600000000000001 195.50344827586207 29.2 199.17241379310346 29.2C 202.84137931034485 29.2 205.98620689655172 18.4 209.6551724137931 18.4C 213.3241379310345 18.4 216.46896551724137 22.8 220.13793103448276 22.8C 223.80689655172415 22.8 226.95172413793102 32.4 230.6206896551724 32.4C 234.2896551724138 32.4 237.43448275862067 21.6 241.10344827586206 21.6C 244.77241379310345 21.6 247.91724137931033 24.4 251.58620689655172 24.4C 255.2551724137931 24.4 258.40000000000003 15.2 262.0689655172414 15.2C 265.73793103448276 15.2 268.8827586206897 19.6 272.55172413793105 19.6C 276.2206896551724 19.6 279.36551724137934 26 283.0344827586207 26C 286.70344827586206 26 289.848275862069 23.6 293.51724137931035 23.6C 297.1862068965517 23.6 300.33103448275864 13.2 304 13.2" fill="none" fill-opacity="1" stroke="#206bc4" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask6m5a2g1)" pathTo="M 0 25.2C 3.668965517241379 25.2 6.813793103448276 26 10.482758620689655 26C 14.151724137931033 26 17.29655172413793 22.4 20.96551724137931 22.4C 24.63448275862069 22.4 27.779310344827586 28.8 31.448275862068964 28.8C 35.11724137931034 28.8 38.26206896551724 25.6 41.93103448275862 25.6C 45.6 25.6 48.744827586206895 30.4 52.41379310344828 30.4C 56.08275862068965 30.4 59.227586206896554 14 62.89655172413793 14C 66.56551724137931 14 69.71034482758621 27.6 73.37931034482759 27.6C 77.04827586206896 27.6 80.19310344827586 25.2 83.86206896551724 25.2C 87.53103448275861 25.2 90.67586206896551 24.4 94.34482758620689 24.4C 98.01379310344828 24.4 101.15862068965517 15.2 104.82758620689656 15.2C 108.49655172413793 15.2 111.64137931034483 19.6 115.3103448275862 19.6C 118.97931034482758 19.6 122.12413793103448 26 125.79310344827586 26C 129.46206896551723 26 132.60689655172413 23.6 136.27586206896552 23.6C 139.9448275862069 23.6 143.08965517241379 26 146.75862068965517 26C 150.42758620689656 26 153.57241379310344 29.2 157.24137931034483 29.2C 160.91034482758621 29.2 164.0551724137931 2.799999999999997 167.72413793103448 2.799999999999997C 171.39310344827587 2.799999999999997 174.53793103448274 18.8 178.20689655172413 18.8C 181.87586206896552 18.8 185.0206896551724 15.600000000000001 188.68965517241378 15.600000000000001C 192.35862068965517 15.600000000000001 195.50344827586207 29.2 199.17241379310346 29.2C 202.84137931034485 29.2 205.98620689655172 18.4 209.6551724137931 18.4C 213.3241379310345 18.4 216.46896551724137 22.8 220.13793103448276 22.8C 223.80689655172415 22.8 226.95172413793102 32.4 230.6206896551724 32.4C 234.2896551724138 32.4 237.43448275862067 21.6 241.10344827586206 21.6C 244.77241379310345 21.6 247.91724137931033 24.4 251.58620689655172 24.4C 255.2551724137931 24.4 258.40000000000003 15.2 262.0689655172414 15.2C 265.73793103448276 15.2 268.8827586206897 19.6 272.55172413793105 19.6C 276.2206896551724 19.6 279.36551724137934 26 283.0344827586207 26C 286.70344827586206 26 289.848275862069 23.6 293.51724137931035 23.6C 297.1862068965517 23.6 300.33103448275864 13.2 304 13.2" pathFrom="M -1 40L -1 40L 10.482758620689655 40L 20.96551724137931 40L 31.448275862068964 40L 41.93103448275862 40L 52.41379310344828 40L 62.89655172413793 40L 73.37931034482759 40L 83.86206896551724 40L 94.34482758620689 40L 104.82758620689656 40L 115.3103448275862 40L 125.79310344827586 40L 136.27586206896552 40L 146.75862068965517 40L 157.24137931034483 40L 167.72413793103448 40L 178.20689655172413 40L 188.68965517241378 40L 199.17241379310346 40L 209.6551724137931 40L 220.13793103448276 40L 230.6206896551724 40L 241.10344827586206 40L 251.58620689655172 40L 262.0689655172414 40L 272.55172413793105 40L 283.0344827586207 40L 293.51724137931035 40L 304 40"></path><g id="SvgjsG2704" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2733" r="0" cx="0" cy="0" class="apexcharts-marker wq60c5kvp no-pointer-events" stroke="#ffffff" fill="#206bc4" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2705" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine2728" x1="0" y1="0" x2="304" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2729" x1="0" y1="0" x2="304" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2730" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2731" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2732" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect2668" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2716" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG2665" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 20px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(32, 107, 196);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
          <div class="resize-triggers"><div class="expand-trigger"><div style="width: 305px; height: 137px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body" style="position: relative;">
              <div class="d-flex align-items-center">
                <div class="subheader">New clients</div>
                <div class="ms-auto lh-1">
                  <div class="dropdown">
                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item active" href="#">Last 7 days</a>
                      <a class="dropdown-item" href="#">Last 30 days</a>
                      <a class="dropdown-item" href="#">Last 3 months</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-baseline">
                <div class="h1 mb-3 me-2">6,782</div>
                <div class="me-auto">
                  <span class="text-yellow d-inline-flex align-items-center lh-1">
                    0% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  </span>
                </div>
              </div>
              <div id="chart-new-clients" class="chart-sm" style="min-height: 40px;"><div id="apexchartsja1n7fil" class="apexcharts-canvas apexchartsja1n7fil apexcharts-theme-light" style="width: 272px; height: 40px;"><svg id="SvgjsSvg2736" width="272" height="40" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent none repeat scroll 0% 0%;"><g id="SvgjsG2738" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2737"><clipPath id="gridRectMaskja1n7fil"><rect id="SvgjsRect2774" width="278" height="42" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskja1n7fil"></clipPath><clipPath id="nonForecastMaskja1n7fil"></clipPath><clipPath id="gridRectMarkerMaskja1n7fil"><rect id="SvgjsRect2775" width="276" height="44" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><line id="SvgjsLine2743" x1="0" y1="0" x2="0" y2="40" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="40" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG2785" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2786" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG2793" class="apexcharts-grid"><g id="SvgjsG2794" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine2796" x1="0" y1="0" x2="272" y2="0" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2797" x1="0" y1="8" x2="272" y2="8" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2798" x1="0" y1="16" x2="272" y2="16" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2799" x1="0" y1="24" x2="272" y2="24" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2800" x1="0" y1="32" x2="272" y2="32" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line><line id="SvgjsLine2801" x1="0" y1="40" x2="272" y2="40" stroke="#e0e0e0" stroke-dasharray="4" class="apexcharts-gridline"></line></g><g id="SvgjsG2795" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine2803" x1="0" y1="40" x2="272" y2="40" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine2802" x1="0" y1="1" x2="0" y2="40" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG2776" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG2777" class="apexcharts-series" seriesName="May" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2780" d="M 0 25.2C 3.2827586206896546 25.2 6.096551724137931 26 9.379310344827585 26C 12.66206896551724 26 15.475862068965515 22.4 18.75862068965517 22.4C 22.041379310344826 22.4 24.855172413793102 28.8 28.137931034482758 28.8C 31.420689655172414 28.8 34.234482758620686 25.6 37.51724137931034 25.6C 40.8 25.6 43.61379310344827 30.4 46.89655172413793 30.4C 50.179310344827584 30.4 52.99310344827586 14 56.275862068965516 14C 59.55862068965517 14 62.37241379310344 27.6 65.6551724137931 27.6C 68.93793103448274 27.6 71.75172413793103 25.2 75.03448275862068 25.2C 78.31724137931033 25.2 81.13103448275862 24.4 84.41379310344827 24.4C 87.69655172413792 24.4 90.51034482758621 15.2 93.79310344827586 15.2C 97.0758620689655 15.2 99.8896551724138 19.6 103.17241379310344 19.6C 106.4551724137931 19.6 109.26896551724138 26 112.55172413793103 26C 115.83448275862068 26 118.64827586206896 23.6 121.9310344827586 23.6C 125.21379310344827 23.6 128.02758620689653 26 131.3103448275862 26C 134.59310344827585 26 137.40689655172412 29.2 140.68965517241378 29.2C 143.97241379310344 29.2 146.7862068965517 2.799999999999997 150.06896551724137 2.799999999999997C 153.35172413793103 2.799999999999997 156.1655172413793 18.8 159.44827586206895 18.8C 162.73103448275862 18.8 165.54482758620688 15.600000000000001 168.82758620689654 15.600000000000001C 172.1103448275862 15.600000000000001 174.92413793103447 29.2 178.20689655172413 29.2C 181.4896551724138 29.2 184.30344827586205 18.4 187.58620689655172 18.4C 190.86896551724138 18.4 193.68275862068964 22.8 196.9655172413793 22.8C 200.24827586206897 22.8 203.06206896551723 38.4 206.3448275862069 38.4C 209.62758620689655 38.4 212.44137931034481 21.6 215.72413793103448 21.6C 219.00689655172414 21.6 221.8206896551724 24.4 225.10344827586206 24.4C 228.3862068965517 24.4 231.2 15.2 234.48275862068962 15.2C 237.76551724137929 15.2 240.57931034482755 19.6 243.8620689655172 19.6C 247.14482758620687 19.6 249.95862068965513 26 253.2413793103448 26C 256.52413793103443 26 259.3379310344827 23.6 262.6206896551724 23.6C 265.90344827586205 23.6 268.71724137931034 13.2 272 13.2" fill="none" fill-opacity="1" stroke="rgba(32,107,196,1)" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskja1n7fil)" pathTo="M 0 25.2C 3.2827586206896546 25.2 6.096551724137931 26 9.379310344827585 26C 12.66206896551724 26 15.475862068965515 22.4 18.75862068965517 22.4C 22.041379310344826 22.4 24.855172413793102 28.8 28.137931034482758 28.8C 31.420689655172414 28.8 34.234482758620686 25.6 37.51724137931034 25.6C 40.8 25.6 43.61379310344827 30.4 46.89655172413793 30.4C 50.179310344827584 30.4 52.99310344827586 14 56.275862068965516 14C 59.55862068965517 14 62.37241379310344 27.6 65.6551724137931 27.6C 68.93793103448274 27.6 71.75172413793103 25.2 75.03448275862068 25.2C 78.31724137931033 25.2 81.13103448275862 24.4 84.41379310344827 24.4C 87.69655172413792 24.4 90.51034482758621 15.2 93.79310344827586 15.2C 97.0758620689655 15.2 99.8896551724138 19.6 103.17241379310344 19.6C 106.4551724137931 19.6 109.26896551724138 26 112.55172413793103 26C 115.83448275862068 26 118.64827586206896 23.6 121.9310344827586 23.6C 125.21379310344827 23.6 128.02758620689653 26 131.3103448275862 26C 134.59310344827585 26 137.40689655172412 29.2 140.68965517241378 29.2C 143.97241379310344 29.2 146.7862068965517 2.799999999999997 150.06896551724137 2.799999999999997C 153.35172413793103 2.799999999999997 156.1655172413793 18.8 159.44827586206895 18.8C 162.73103448275862 18.8 165.54482758620688 15.600000000000001 168.82758620689654 15.600000000000001C 172.1103448275862 15.600000000000001 174.92413793103447 29.2 178.20689655172413 29.2C 181.4896551724138 29.2 184.30344827586205 18.4 187.58620689655172 18.4C 190.86896551724138 18.4 193.68275862068964 22.8 196.9655172413793 22.8C 200.24827586206897 22.8 203.06206896551723 38.4 206.3448275862069 38.4C 209.62758620689655 38.4 212.44137931034481 21.6 215.72413793103448 21.6C 219.00689655172414 21.6 221.8206896551724 24.4 225.10344827586206 24.4C 228.3862068965517 24.4 231.2 15.2 234.48275862068962 15.2C 237.76551724137929 15.2 240.57931034482755 19.6 243.8620689655172 19.6C 247.14482758620687 19.6 249.95862068965513 26 253.2413793103448 26C 256.52413793103443 26 259.3379310344827 23.6 262.6206896551724 23.6C 265.90344827586205 23.6 268.71724137931034 13.2 272 13.2" pathFrom="M -1 40L -1 40L 9.379310344827585 40L 18.75862068965517 40L 28.137931034482758 40L 37.51724137931034 40L 46.89655172413793 40L 56.275862068965516 40L 65.6551724137931 40L 75.03448275862068 40L 84.41379310344827 40L 93.79310344827586 40L 103.17241379310344 40L 112.55172413793103 40L 121.9310344827586 40L 131.3103448275862 40L 140.68965517241378 40L 150.06896551724137 40L 159.44827586206895 40L 168.82758620689654 40L 178.20689655172413 40L 187.58620689655172 40L 196.9655172413793 40L 206.3448275862069 40L 215.72413793103448 40L 225.10344827586206 40L 234.48275862068962 40L 243.8620689655172 40L 253.2413793103448 40L 262.6206896551724 40L 272 40"></path><g id="SvgjsG2778" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2809" r="0" cx="0" cy="0" class="apexcharts-marker ws5neugjdj no-pointer-events" stroke="#ffffff" fill="#206bc4" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2781" class="apexcharts-series" seriesName="April" data:longestSeries="true" rel="2" data:realIndex="1"><path id="SvgjsPath2784" d="M 0 2.799999999999997C 3.2827586206896546 2.799999999999997 6.096551724137931 18.4 9.379310344827585 18.4C 12.66206896551724 18.4 15.475862068965515 19.6 18.75862068965517 19.6C 22.041379310344826 19.6 24.855172413793102 30.4 28.137931034482758 30.4C 31.420689655172414 30.4 34.234482758620686 26 37.51724137931034 26C 40.8 26 43.61379310344827 26 46.89655172413793 26C 50.179310344827584 26 52.99310344827586 27.6 56.275862068965516 27.6C 59.55862068965517 27.6 62.37241379310344 13.2 65.6551724137931 13.2C 68.93793103448274 13.2 71.75172413793103 32.4 75.03448275862068 32.4C 78.31724137931033 32.4 81.13103448275862 22.8 84.41379310344827 22.8C 87.69655172413792 22.8 90.51034482758621 28.8 93.79310344827586 28.8C 97.0758620689655 28.8 99.8896551724138 25.6 103.17241379310344 25.6C 106.4551724137931 25.6 109.26896551724138 15.2 112.55172413793103 15.2C 115.83448275862068 15.2 118.64827586206896 15.600000000000001 121.9310344827586 15.600000000000001C 125.21379310344827 15.600000000000001 128.02758620689653 29.2 131.3103448275862 29.2C 134.59310344827585 29.2 137.40689655172412 24.4 140.68965517241378 24.4C 143.97241379310344 24.4 146.7862068965517 26 150.06896551724137 26C 153.35172413793103 26 156.1655172413793 23.6 159.44827586206895 23.6C 162.73103448275862 23.6 165.54482758620688 29.2 168.82758620689654 29.2C 172.1103448275862 29.2 174.92413793103447 26 178.20689655172413 26C 181.4896551724138 26 184.30344827586205 19.6 187.58620689655172 19.6C 190.86896551724138 19.6 193.68275862068964 21.6 196.9655172413793 21.6C 200.24827586206897 21.6 203.06206896551723 15.2 206.3448275862069 15.2C 209.62758620689655 15.2 212.44137931034481 25.2 215.72413793103448 25.2C 219.00689655172414 25.2 221.8206896551724 22.4 225.10344827586206 22.4C 228.3862068965517 22.4 231.2 18.8 234.48275862068962 18.8C 237.76551724137929 18.8 240.57931034482755 23.6 243.8620689655172 23.6C 247.14482758620687 23.6 249.95862068965513 14 253.2413793103448 14C 256.52413793103443 14 259.3379310344827 24.4 262.6206896551724 24.4C 265.90344827586205 24.4 268.71724137931034 25.2 272 25.2" fill="none" fill-opacity="1" stroke="rgba(168,174,183,1)" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="3" class="apexcharts-line" index="1" clip-path="url(#gridRectMaskja1n7fil)" pathTo="M 0 2.799999999999997C 3.2827586206896546 2.799999999999997 6.096551724137931 18.4 9.379310344827585 18.4C 12.66206896551724 18.4 15.475862068965515 19.6 18.75862068965517 19.6C 22.041379310344826 19.6 24.855172413793102 30.4 28.137931034482758 30.4C 31.420689655172414 30.4 34.234482758620686 26 37.51724137931034 26C 40.8 26 43.61379310344827 26 46.89655172413793 26C 50.179310344827584 26 52.99310344827586 27.6 56.275862068965516 27.6C 59.55862068965517 27.6 62.37241379310344 13.2 65.6551724137931 13.2C 68.93793103448274 13.2 71.75172413793103 32.4 75.03448275862068 32.4C 78.31724137931033 32.4 81.13103448275862 22.8 84.41379310344827 22.8C 87.69655172413792 22.8 90.51034482758621 28.8 93.79310344827586 28.8C 97.0758620689655 28.8 99.8896551724138 25.6 103.17241379310344 25.6C 106.4551724137931 25.6 109.26896551724138 15.2 112.55172413793103 15.2C 115.83448275862068 15.2 118.64827586206896 15.600000000000001 121.9310344827586 15.600000000000001C 125.21379310344827 15.600000000000001 128.02758620689653 29.2 131.3103448275862 29.2C 134.59310344827585 29.2 137.40689655172412 24.4 140.68965517241378 24.4C 143.97241379310344 24.4 146.7862068965517 26 150.06896551724137 26C 153.35172413793103 26 156.1655172413793 23.6 159.44827586206895 23.6C 162.73103448275862 23.6 165.54482758620688 29.2 168.82758620689654 29.2C 172.1103448275862 29.2 174.92413793103447 26 178.20689655172413 26C 181.4896551724138 26 184.30344827586205 19.6 187.58620689655172 19.6C 190.86896551724138 19.6 193.68275862068964 21.6 196.9655172413793 21.6C 200.24827586206897 21.6 203.06206896551723 15.2 206.3448275862069 15.2C 209.62758620689655 15.2 212.44137931034481 25.2 215.72413793103448 25.2C 219.00689655172414 25.2 221.8206896551724 22.4 225.10344827586206 22.4C 228.3862068965517 22.4 231.2 18.8 234.48275862068962 18.8C 237.76551724137929 18.8 240.57931034482755 23.6 243.8620689655172 23.6C 247.14482758620687 23.6 249.95862068965513 14 253.2413793103448 14C 256.52413793103443 14 259.3379310344827 24.4 262.6206896551724 24.4C 265.90344827586205 24.4 268.71724137931034 25.2 272 25.2" pathFrom="M -1 40L -1 40L 9.379310344827585 40L 18.75862068965517 40L 28.137931034482758 40L 37.51724137931034 40L 46.89655172413793 40L 56.275862068965516 40L 65.6551724137931 40L 75.03448275862068 40L 84.41379310344827 40L 93.79310344827586 40L 103.17241379310344 40L 112.55172413793103 40L 121.9310344827586 40L 131.3103448275862 40L 140.68965517241378 40L 150.06896551724137 40L 159.44827586206895 40L 168.82758620689654 40L 178.20689655172413 40L 187.58620689655172 40L 196.9655172413793 40L 206.3448275862069 40L 215.72413793103448 40L 225.10344827586206 40L 234.48275862068962 40L 243.8620689655172 40L 253.2413793103448 40L 262.6206896551724 40L 272 40"></path><g id="SvgjsG2782" class="apexcharts-series-markers-wrap" data:realIndex="1"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2810" r="0" cx="0" cy="0" class="apexcharts-marker wjt90mtpdh no-pointer-events" stroke="#ffffff" fill="#a8aeb7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2779" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG2783" class="apexcharts-datalabels" data:realIndex="1"></g></g><line id="SvgjsLine2804" x1="0" y1="0" x2="272" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2805" x1="0" y1="0" x2="272" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2806" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2807" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2808" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect2742" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2792" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG2739" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 20px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(32, 107, 196);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(168, 174, 183);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 305px; height: 137px;"></div></div><div class="contract-trigger"></div></div></div>
          </div>
        </div>
      </div>
    @endsection