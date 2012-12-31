<?php 
/*
*** Exercice ***
Construire la classe Form pour créer des formulaires

Instancier l'objet $form :
$form = new Form ;
$form->addElement( array('name' => 'nom', 'type' => 'text', 'label' => 'Votre nom'));

Ce qui générera ceci en html :
<label for="forNom"> Votre nom :</label>
<input type="type" name="nom" value="" />


// indication :
tester l'existence des clés à l'aide de isset($arg['label']) ...

*/

class Form {
	private $elements 	= array();
	private $value ;
	private $post_value ;
	private $method = 'post' ;
	private $errors = array() ;

	public function setErrors($args) {
		foreach ($args as $key => $this->value) {
		$this->errors[$key] = $this->value ;
		}
	}

	public function addElement($args) {
		if (isset($args['tag'])) {
			if ($args['tag'] == 'input') {
				if (isset($args['name'])) {
					$name = $args['name'] ;
					$labelFor =  $args['name'] ;
				}else {
					$name = 'wo_name' ;
					$labelFor = 'wo_name' ;
				}
				if (isset($args['type'])) {
					$type = $args['type'] ;
				}
				if (isset($args['label'])) {
					$label = $args['label'] ;
				}
				if (isset($args['placeholder'])) {
					$placeholder = $args['placeholder'] ;
				}
				$this->elements[] = '<label for="' . $labelFor . '">' . $label . '</label>' . "\n" . '<input type="' . $type . '" name="' . $name . '" placeholder="' . $placeholder . '" />' . "\n" ; 	
			} else if ($args['tag'] == 'datalist') {
				if (isset($args['id'])) {
					$id = $args['id'] ;
				}
				if (isset($args['value'])) {
					$options = explode(",", $args['value']) ;
					foreach ($options as $key => $this->value) {
					$this->value[] = '<option value="' . $this->value . '">' ;
					}
				}
				$this->elements[] = '<input list="' . $id . '" />' . "\n" . ' <datalist id="' . $id . '">' . "\n" . ' ' . implode("\n", $this->value) . "\n" . ' </datalist>' ;

			} else {
				if (isset($args['name'])) {
					$name = $args['name'] ;
					$labelFor = $args['name'] ;
				}else {
					$name = 'wo_name' ;
				}
				if (isset($args['type'])) {
					$type = $args['type'] ;
				}
				if (isset($args['label'])) {
					$label = $args['label'] ;
				}
				if (isset($args['placeholder'])) {
					$placeholder = $args['placeholder'] ;
				} else {
					$placeholder = '' ;
				}
			$this->elements[] = '<label for="' . $labelFor . '">' . $label . '</label>' . "\n" . ' <input type="' . $type . '" name="' . $name . '" placeholder="' . $placeholder . '" />' . "\n" ; 	
			} // fin du input
		} // fin du args['tags']
	}

	public function addGeneral($args) {
		if (is_array($args)) {
			foreach ($$args as $key => $value) {
				$this->elements[] = $value . "\n";
			}
		} else {
			$this->elements[] = $args . "\n" ; 	
		}

	}

	public function addInput($args) {
		// $before = memory_get_usage() ;
		if (isset($args['name'])) {
			$name = ' name="' . $args['name'] . '"' ;
			$labelFor = $args['name'];
		}else {
			$name = ' name="wo_name"' ;
			$labelFor = 'wo_name';
		}
		if (isset($args['type'])) {
			$type = ' type="' . $args['type'] . '"' ;
		} else {
			$type = 'type="text"' ;
		}
		if (isset($args['placeholder'])) {
			$placeholder = ' placeholder="' . $args['placeholder'] . '"' ;
		} else {
			$placeholder = '' ;
		}
		if (isset($this->errors[$args['name']])) {
			$errors_bloc 	= '<p class="text-error">' . $this->errors[$args['name']] . '</p>' ;
			$errors 		= 'error' ;
		} else {
			$errors 	= '' ;
		}
		if (isset($args['id'])) {
			$id = ' id="' . $args['id'] . '"' ;
		} else {
			$id = '' ;
		}
		if (isset($args['class'])) {
			$class = ' class="' . $args['class'] . '"' ;
		} else {
			$class = '' . $errors ;
		}
		if (isset($_POST[$args['name']])) {
			$this->post_value = ' value ="' . $_POST[$args['name']] . '"' ;
		} else {
			$this->post_value = '' ;
		}
		if (isset($args['label']) && $args['label'] == 'oui') {
			if (isset($args['label_value'])) {
				$label_value = $args['label_value'] ;
			} else {
				$label_value = '' ;
			}
			$this->elements[] = '<label for="' . $args['name'] . '">' . $label_value . " :</label>\n" ;
		}

		// $after = memory_get_usage() ;
		// $difference = $after - $before ;

		$this->elements[] = '<input' . $type . $class . $name . $placeholder . $id . $this->post_value . ' />' . "\n" ; 	
		if (isset($errors_bloc)) {
			$this->elements[] = $errors_bloc ;
		}
	} 

	public function addInputNumber($args) {
		if (isset($args['name'])) {
			$name = $args['name'] ;
			$labelFor = $name;
		}else {
			$name = 'wo_name_number' ;
			$labelFor = 'wo_name_number';
		}
		if (isset($args['type'])) {
			$type = $args['type'] ;
		} else {
			$type = 'number' ;
		}
		if (isset($this->errors[$args['name']])) {
			$errors_bloc 	= '<p class="text-error">' . $this->errors[$args['name']] . '</p>' ;
			$errors 		= 'error' ;
		} else {
			$errors 	= '' ;
		}
		if (isset($args['min'])) {
			$min = $args['min'] ;
		} else {
			$min = '' ;
		}
		if (isset($args['max'])) {
			$max = $args['max'] ;
		} else {
			$max = '' ;
		}
		if (isset($args['step'])) {
			$step = $args['step'] ;
		} else {
			$step = '' ;
		}
		if (isset($args['id'])) {
			$id = $args['id'] ;
		} else {
			$id = '' ;
		}
		if (isset($args['class'])) {
			$class = $args['class'] ;
		} else {
			$class = '' . $errors ;
		}
		if (isset($args['label']) && $args['label'] == 'oui') {
			if (isset($args['label_value'])) {
				$label_value = $args['label_value'] ;
			} else {
				$label_value = '' ;
			}
			$this->elements[] = '<label for="' . $name . '">' . $label_value . " :</label>\n" ;
		}

		if (isset($_POST[$args['name']])) {
			$this->post_value = ' value ="' . $_POST[$args['name']] . '"' ;
		} else {
			$this->post_value = '' ;
		}

		$this->elements[] = '<input type="' . $type . '" class="' . $class . '" name="' . $name . '" min="' . $min . '" max="' . $max . '" step="' . $step . '" id="' . $id . '"' . $this->post_value . ' />' . "\n" ; 	
		if (isset($errors_bloc)) {
			$this->elements[] = $errors_bloc ;
		}
	} 

	public function addOutput($args) {
		if (isset($args['name'])) {
			$name = $args['name'] ;
			$labelFor = $name;
		}else {
			$name = 'wo_name' ;
			$labelFor = 'wo_name';
		}
		if (isset($args['placeholder'])) {
			$placeholder = ' placeholder="' . $args['placeholder'] . '"' ;
		} else {
			$placeholder = '' ;
		}
		if (isset($this->errors[$args['name']])) {
			$errors_bloc 	= '<p class="text-error">' . $this->errors[$args['name']] . '</p>' ;
			$errors 		= 'error' ;
		} else {
			$errors 	= '' ;
		}
		if (isset($args['class'])) {
			$class = ' class="' . $args['class'] . $errors . '"'  ;
		} else {
			$class = '' . $errors ;
		}
		if (isset($args['id'])) {
			$id =  ' id="' . $args['id'] . '"' ;
		} else {
			$id = '' ;
		}
		if (isset($args['for'])) {
			$for = $args['for'] ;
		} else {
			$for = '' ;
		}
		if (isset($args['form'])) {
			$form = $args['form'] ;
		} else {
			$form = '' ;
		}
		if (isset($args['label']) && $args['label'] == 'oui') {
			if (isset($args['label_value'])) {
				$label_value = $args['label_value'] ;
			} else {
				$label_value = '' ;
			}
			$this->elements[] = '<label for="' . $name . '">' . $label_value . " :</label>\n" ;
		}

		$this->elements[] = '<output name="' . $name . '" for="' . $for . '" form="' . $form . '"' . $class . $id . '  />' . "\n" ; 	
		if (isset($errors_bloc)) {
			$this->elements[] = $errors_bloc ;
		}

	} 

	public function addDatalist($args) {
		$this->value = array() ;
		if (isset($args['id'])) {
			$id = $args['id'] ;
		} else {
			$id = '' ;
		}
		if (isset($args['list'])) {
			$list = $args['list'] ;
		} else {
			$list = '';
		}
		if (isset($args['type'])) {
			$type = $args['type'] ;
		} else {
			$type = ' type="text"' ;
		}
		if (isset($args['name'])) {
			$name = $args['name'] ;
		} else {
			$name = '' ;
		}
		if (isset($args['class'])) {
			$class = ' class="' . $args['class'] . '"' ;
		} else {
			$class = '' ;
		}
		if (isset($args['label']) && $args['label'] == 'oui') {
			$this->elements[] = '<label for="' . $name . '">' . ucfirst($name) . " :</label>\n" ;
		}
		if (isset($args['placeholder'])) {
			$placeholder = ' placeholder="' .$args['placeholder'] . '"' ;
		} else {
			$placeholder = '' ;
		}
		if (isset($args['value'])) {
			$options = explode(",", $args['value']) ;
			foreach ($options as $key => $value) {
			$this->value[] = '<option value="' . $value . '">' ;
			}
		}
		$this->elements[] = '<input list="' . $list . '" name="' . $name . '"' . $type . $class . $placeholder . '/>' . "\n" 
		. ' <datalist id="' . $list . '">' . "\n" 
		. ' ' . implode("\n", $this->value) . "\n" 
		. ' </datalist>' ;
		if (isset($this->errors[$args['name']])) {
			$this->elements[] = '<p class="text-error">' . $this->errors[$args['name']] . '</p>' ;
		}
	}

	public function addForm($args) {
		if (isset($args['method'])) {
			// définir la méthod à post ou get
			$method = $args['method'] ;
		}
		if (isset($args['action'])) {
			$action = $args['action'] ;
		}
		if (isset($args['id'])) {
			$id = $args['id'] ;
		}
		if (isset($args['class'])) {
			$class = ' class="' . $args['class'] . '"'  ;
		} else {
			$class = '' ;
		}
		$this->elements[] = '<form method="' . $method . '" action="' . $action . '" id="' . $id . '"' . $class . ' >' ;
	}

	public function closeForm() {
		$this->elements[] = "</form>\n" ;
	}

	public function addFieldset() {
		$this->elements[] = "<fieldset>\n" ;
	}
	public function closeFieldset() {
		$this->elements[] = "</fieldset>\n" ;
	}

	public function addLegend($args) {
		if (isset($args['value'])) {
			$this->value = $args['value'] ;
		}else {
			$this->value = '' ;
		}
		$this->elements[] = '<legend>' . $this->value . '</legend>' . "\n" ; 	
	}

	public function addSubmit($args) {
		if (isset($args['name'])) {
			$name = $args['name'] ;
		} else {
			$name = '' ;
		}
		if (isset($args['value'])) {
			$this->value = ' value="' . $args['value'] . '"' ;
		} else {
			$this->value = '' ;
		}
		if (isset($args['id'])) {
			$id = ' id="' . $args['id'] . '"' ;
		}else {
			$id = '';
		}
		if (isset($args['class'])) {
			$class = ' class="' . $args['class'] . '"' ;
		} else {
			$class = '' ;
		}

		$type = 'submit' ;
		$this->elements[] = '<input type="' . $type .'" name="' . $name .'"' . $this->value . $id . $class . ' />' . "\n" ;
	}

	public function render() {
		return implode("\n", $this->elements) ;
	}


}


$form = new Form ;

if (!empty($_POST)) {
	// on traite le formulaire
	if (empty($_POST['nom'])) {
		$form->setErrors(array('nom' => 'Vous n\'avez pas renseigné votre nom'));
	}
	if (empty($_POST['prenom'])) {
		$form->setErrors(array('prenom' => 'Vous n\'avez pas renseigné votre prénom'));
	}
}

$form->addForm( array('method' => 'post', 'action' => $_SERVER['PHP_SELF'], 'id' => 'contact' ) ) ;
$form->addFieldset() ;
// $form->addGeneral( array()) ;
$form->addLegend( array('value' => 'Civilité')) ;
$form->addInput( array( 'label' => 'oui', 'name' => 'nom', 'type' => 'text', 'label_value' => 'Votre nom', 'placeholder' => 'Votre nom'));
$form->addInput( array( 'label' => 'oui', 'name' => 'prenom', 'type' => 'text', 'label_value' => 'Votre Prénom', 'placeholder' => 'Votre prénom'));
$form->addDatalist( array( 'list' => 'pays', 'name' =>'pays', 'value' => 'France,Etats-Unis', 'placeholder' => 'Votre pays', 'label' => 'oui'));
$form->closeFieldset() ;
$form->addSubmit(array('value' => 'Envoyer', 'class' => 'btn')) ;
$form->closeForm() ;

?>
<!DOCTYPE HTML>
<html lang="fr-FR">
<head>
	<meta charset="UTF-8" />
	<title>La class Form</title>
	<meta name="author" content="Teddy Payet" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>
	<script src="//twitter.github.com/bootstrap/assets/js/google-code-prettify/prettify.js"></script>

	<script type="text/javascript">
	jQuery(document).ready(function($) {
		prettyPrint();
	});
	</script>

	<!-- CSS Bootstrap for good looking pages -->
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.css" rel="stylesheet" />
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="//twitter.github.com/bootstrap/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
<!-- 
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
 -->
<style type="text/css">
	.subhead {
		padding-top: 50px;
	}
</style>
</head>
<body class="article">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<nav>
					<a href="form.php" class="brand">La classe !</a>
					<ul class="nav">
						<li><a href="#">Un lien</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<header class="jumbotron subhead">
		<div class="container">
			<div class="row-fluid">
				<div class="span12">
						<div class="hero-unit">
							<h2>class Form</h2>
							<p>On va créer une classe Form qui construira un formulaire<br />
								<small>test avec $variable au lieu de $this->variable pour des tests mémoires</small></p>
						</div>
				</div>
			</div> <!-- fin de .row-fluid -->
		</div> <!-- end header .container -->
	</header>
	<!-- #content -->
	<div id="content" class="container">
		<div class="row-fluid">
			<!-- .span8 -->
			<div class="span8">
				<?php 
				echo $form->render() ;
				?>
			</div>
			<!-- /.span8 -->
			<!-- .span4 -->
			<div class="span4">
				<h3>Catégorie</h3>
			</div>
			<!-- /.span4 -->
		</div>
	</div>
	<!-- /#content -->

	<footer class="footer subhead">
		<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<p>Le pied !</p>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
			<?php 
				echo "<pre>";
				var_dump($_POST);
				echo "</pre>";
				echo "<pre>";
				var_dump($form) ;
				echo "</pre>";
				?>
			</div>
		</div>
		</div><!-- end .container -->
	</footer>
</body>
</html>