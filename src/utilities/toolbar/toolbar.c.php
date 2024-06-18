<div id="sherpa_dev_toolbar" sherpa-utilities>

  <div id="sherpa_dev_toolbar__server_loading_time">
    Server: <span><?= $serverLoadingTime ?></span>ms
  </div>

  <div id="sherpa_dev_toolbar__client_loading_time">
    Client: <span>--</span>ms
  </div>

  <div id="sherpa_dev_toolbar__route_path">
    Path: <?= $currentRoute->getPath() ?>
  </div>

  <div id="sherpa_dev_toolbar__route_http_method">
    HTTP method: <?= $currentRoute->getHttpMethod()->value ?>
  </div>

  <div id="sherpa_dev_toolbar__route_controller">
    Controller: <span>--</span>
  </div>

  <div id="sherpa_dev_toolbar__route_controller_method">
    Method: <?= $currentRoute->getControllerMethod() ?>
  </div>

</div>


<script>

  let startLoadingTime,
      endLoadingTime;

  window.addEventListener("load", () => {
      setTimeout(() => {
          let [navigationEntry] = performance.getEntriesByType("navigation"),
              loadingTime = (navigationEntry.loadEventEnd - navigationEntry.startTime).toFixed();

          console.log("Page loading time = " + loadingTime);

          document.querySelector("#sherpa_dev_toolbar__client_loading_time > span")
              .innerText = loadingTime;
      }, 0);
  });


  let controllerClassPathParts = "<?= $currentRoute->getControllerClass() ?>".split('\\');

  document.querySelector("#sherpa_dev_toolbar__route_controller > span")
      .innerText = controllerClassPathParts[controllerClassPathParts.length - 1];

</script>


<style>

#sherpa_dev_toolbar {
  --background: #2d2d2d;


  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;

  min-height: 60px;

  background: var(--background);

  display: flex;
  align-items: center;
  flex-wrap: wrap;
  column-gap: 20px;
  row-gap: 5px;

  color: white;
  font-family: monospace;

  padding: 0 50px;
}

</style>