<div id="sherpa_dev_toolbar" sherpa-utilities>

  <div id="sherpa_dev_toolbar__server_loading_time">
    Server: <?= $serverLoadingTime ?>ms
  </div>

  <div id="sherpa_dev_toolbar__client_loading_time">
    Client: <?= $clientLoadingTime ?>ms
  </div>

</div>


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