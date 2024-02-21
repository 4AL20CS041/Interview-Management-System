<?php

  include ("DB.php");
  include_once ("session.php");
  class View {
    private $db;
    private $msgSession;
    function __construct(){
      $this->db = new DB();
      $this->msgSession = new Session();
    }

    function viewCandidate(){
      $sql = "select * from candidates";
      $query = $this->db->simplequerywithoutcondition($sql);
      $results = $query->fetchAll();
      return $results;
    }

    function viewQuestions(){
      $sql = "select * from questions";
      $query = $this->db->simplequerywithoutcondition($sql);
      $results = $query->fetchAll();
      return $results;
    }


    function viewEditQuestions(){

      $questionId = $_GET['id'];
      $sql = "select * from questions where question_id = $questionId";
      $query = $this->db->simplequerywithoutcondition($sql);
      $results = $query->fetchAll();
      return $results;
    }

    function viewReport(){

      $candId = $_GET['id'];
      $sql = "select * from questions, reports, candidates where reports.cand_id = candidates.cand_id and reports.question_id = questions.question_id and reports.cand_id = $candId";
      $query = $this->db->simplequerywithoutcondition($sql);
      $results = $query->fetchAll();
      return $results;
    }

    function viewReportComment(){
      $candId = $_GET['id'];
      $sql = "select * from comments where comments.cand_id = $candId";
      $query = $this->db->simplequerywithoutcondition($sql);
      $results = $query->fetchAll();
      return $results;
    }
  }
