<?php 
class Transaction extends ActiveRecord\Model
{
    /*static $validates_presence_of = array(
        array('profile_id', 'message' => 'Precisa ter um perfil'),
        array('amount', 'messsage' => 'Preencha o campo corretamente'),
        array('due_date_at', 'messsage' => 'Preencha o campo corretamente'),
    );*/

    public static function getUrlFilters()
    {
        $filters = array(
            'profile_id'    => null,
            'category_id'   => null,
            'account_id'    => null,
            'inout'         => null,
        );

        if (isset($_GET['profile_id']) && (int)$_GET['profile_id'] > 0)
            $filters['profile_id'] = (int)$_GET['profile_id'];

        if (isset($_GET['category_id']) && (int)$_GET['category_id'] > 0)
            $filters['category_id'] = (int)$_GET['category_id'];

        if (isset($_GET['account_id']) && (int)$_GET['account_id'] > 0)
            $filters['account_id'] = (int)$_GET['account_id'];

        if (isset($_GET['inout']) && in_array($_GET['inout'], array('in', 'out')))
            $filters['inout'] = $_GET['inout'];

        /*if (isset($_GET['dd_month']) && (int)$_GET['dd_month'] > 0)
            $filters['due_date_at'] = $_GET['dd_month'];*/

        return $filters;
    }

    public static function simple()
    {
        $offset = 0;
        $limit = 10;
        $order = 'due_date_at DESC';

        $url_conditions = get_url_conditions();

        $offset = $url_conditions['offset'];
        $limit = $url_conditions['limit'];

        $where = array();
        
        // filtra sempre pelo mes atual
        //$where['due_date_at > "?"'] = date('Y-m-').'01';

        foreach (self::getUrlFilters() as $key => $value) {
            
            if (is_null($value)) continue;

            $where[$key] = $value;

        }

        $conditions = array(
            'conditions'    => $where// array(implode(' AND ', array_keys($where)), array_values($where)),
        );
        
        $conditions['limit'] = $limit;
        $conditions['order'] = $order;
        $conditions['offset'] = $offset;
 
        return self::find("all", $conditions);
    }

    public function saveFromPost()
    {
        $t =& $this;
        $t->description = $_POST['description'];
        $t->due_date_at = date('Y-m-d H:i:s', strtotime($_POST['due_date_at']));
        if (isset($_POST['payed_at']) && !empty($_POST['payed_at']))
            $t->payed_at = date('Y-m-d H:i:s', strtotime($_POST['payed_at']));
        $t->category_id = 1; // default
        $t->account_id = 1; // default
        $t->profile_id = 1; // default
        $t->user_id = 1; // default
        if (isset($_POST['payee_name']))
            $t->payee_name = $_POST['payee_name']; // favorecido
        $t->amount = $_POST['amount'];
        //$t->inout = isset($_POST['inout']) && $_POST['inout'] == 'in' ? 'in' : 'out'; // in:entrada, out:saida

        if ($t->amount >= 0)
            $t->inout = 'in'; // in:entrada, out:saida
        else
            $t->inout = 'out'; // in:entrada, out:saida

        return $t->save();
        
        //return $t;
    }

    public function getInOut()
    {
        if ($this->inout=='in') {
        
            return 'Entrada';
        
        } else {
            
            return 'Saida';

        }
    }
    
    public function getCategory()
    {
        if ($this->category_id==1) {
            return 'Padrão';
        }
    }

    public function getAccount()
    {
        if ($this->account_id==1) {
            return 'Padrão';
        }
    }

    public function getAmount()
    {
        if (!empty($this->amount)) {
            $str = 'R$ '.number_format($this->amount, 2, ',', '.');
        }

        if ($this->amount > 0) {
            return sprintf('<span class="text-success">%s</span>', $str);
        } else {
            return sprintf('<span class="text-warning">%s</span>', $str);
        }
    }

    public function getPayedAt($format='Y-m-d')
    {
        if (!empty($this->payed_at)) {

            //return date($format, $this->payed_at);
            return $this->payed_at->format($format);

        } else {

            return $this->payed_at;

        }
    }

    public function getDueDateAt($format='Y-m-d')
    {
        if (!empty($this->due_date_at)) {

            //return date($format, $this->due_date_at);
            return $this->due_date_at->format($format);

        } else {

            return $this->due_date_at;
            
        }
    }

}