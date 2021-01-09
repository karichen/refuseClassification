<?php
class RubbishClassify{
	
	protected function request($url, $data, $headers=array()){
        try{
            $result = $this->validate($url, $data);
            if($result !== true){
                return $result;
            }

            $params = array();
            $authObj = $this->auth();

            if($this->isCloudUser === false){
                $params['access_token'] = $authObj['access_token'];
            }

            // 特殊处理
            $this->proccessRequest($url, $params, $data, $headers);

            $headers = $this->getAuthHeaders('POST', $url, $params, $headers);
            $response = $this->client->post($url, $data, $params, $headers);

            $obj = $this->proccessResult($response['content']);

            if(!$this->isCloudUser && isset($obj['error_code']) && $obj['error_code'] == 110){
                $authObj = $this->auth(true);
                $params['access_token'] = $authObj['access_token'];
                $response = $this->client->post($url, $data, $params, $headers);
                $obj = $this->proccessResult($response['content']);
            }

            if(empty($obj) || !isset($obj['error_code'])){
                $this->writeAuthObj($authObj);
            }
        }catch(Exception $e){
            return array(
                'error_code' => 'SDK108',
                'error_msg' => 'connection or read data timeout',
            );
        }

        return $obj;
    }
}
?>