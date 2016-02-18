<?php
use model\Agent;
use model\Member;
use model\LogAgent;
use model\LogMember;
class c9900 extends pub\GatewayApi{
    const TYPE_AGENT = 'agent';
    const TYPE_MEMBER = 'member';
    public function run() 
    {
        $is_agent = $this->type() == self::TYPE_AGENT;
        $result = $is_agent
            ? LogAgent::with(
                LogAgent::all($this->options()),
                array('agent', 'editor')
            ) : LogMember::with(
                LogMember::all($this->options()),
                array('member', 'editor')
            );
        $rows = array();
        $columns = array('id', 'ip', 'datetime');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['action'] = $row->action();
            $tmp['editor'] = $row->editor ? $row->editor->age006 : 'unknown';
            $tmp['type'] = $this->type();
            $tmp['list'] = ($is_agent) 
                ? ($row->agent ? $row->agent->age001 : 0)
                : ($row->member ? $row->member->mem001 : 0);
            $tmp['account'] = ($is_agent) 
                ? ($row->agent ? $row->agent->age004 : 'unknown')
                : ($row->member ? $row->member->mem011 : 'unknown');
            $tmp['name'] = ($is_agent) 
                ? ($row->agent ? $row->agent->age006 : 'unknown')
                : ($row->member ? $row->member->mem005 : 'unknown');
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => $is_agent 
                ? LogAgent::count($this->options(true))
                : LogMember::count($this->options(true))
        );
        

    }

    public function type() {
        return Input::post('type', self::TYPE_AGENT);
    }



    public function options($is_count = false) 
    {
        $is_agent = ($this->type() == self::TYPE_AGENT);
        $options = array('conditions' => array());

        $query = trim(Input::post('query', ''));
        if (mb_strlen($query) > 0) {
            $column =  $is_agent  ? 'lag003' : 'lmb003';
            $options['conditions'][0] = "{$column} IN (?)";
            $options['conditions'][] = $is_agent 
                ? $this->findAgent($query)
                : $this->findMember($query);
        }


        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = ($is_agent ? 'lag007' : 'lmb007') . ' DESC';
        }
        return $options;
    }


}