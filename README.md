# PHP OOP Design Patterns Learning

## Fundamentos OO

- Abstração
- Encapsulamento
- Polimorfismo
- Herança

## Princípios OO

- Encapsule o que varia.
- Dê prioridade à composição em relação a herança.
- Programe para uma interface, não para um implementação.
- Busque projetos levemente ligados entre objetos que interagem.
- As classes devem estar abertas para extensão, mas fechadas para modificação.
- Dependa de abstrações. Não dependa de classes concretas.
- Princípio do mínimo conhecimento - Só fale com seus amigos mais próximos. A partir do próprio objeto, só podemos invocar métodos que pertençam:
	- Ao próprio objeto;
	- A objetos que tenham sido passados como parâmetros para o método;
	- A qualquer objeto que seja criado ou instanciado pelo método;
	- A quaisquer componentes do objeto. (Qualquer objeto que seja referenciado por uma variável de instância)
- Princípio Hollywood: Não nos telefone, nós telefonamos para você.
	- Evitar o colapso de dependências.
	- Exemplo: A trait de autenticação do Laravel `Illuminate\Foundation\Auth\AuthenticatesUsers`.

## Design Patterns

### Strategy

Define uma famíla de algorítimos, encapsula cada um deles e os torna intercambiáveis.
A estratégia deixa o algorítimo variar independentemente dos clientes que o utilizam.
Exemplo: [strategy.php](strategy.php).

### Observer

Define a dependência UM para MUITOS entre objetos para que quando um objeto mude de estado
todos os seus dependentes sejam avisados e atualizados automaticamente.
Exemplo: [observer.php](observer.php).

### Decorator

Anexa responsabilidades adicionais a um objeto dinamicamente. Os decoradores fornecem
uma alternativa flexivel de subclasse para extender a funcionalidade.
Exemplo: [decorator.php](decorator.php).

### Factory Method

O padrão factory mathod define uma interface para criar um objeto, mas permite as
classes decidir qual classe instanciar. O factory method permite a uma classe deferir
a instanciação para subclasses.
Exemplo: [factory.php](factory.php).

### Abstract Factory

Fornece uma interface para criar famílias de objetos relacionados ou dependentes sem
especificar suas classes concretas.
Exemplo: [factory.php](factory.php).

### Singleton

Garente que uma classe tenha apenas um instância e fornece um ponto global de acesso a ela.
Exemplo: [singleton.php](singleton.php).

### Command

Encapsula uma solicitação como um objeto, o que lhe permite parametrizar outros objetos 
com diferentes solicitações, enfileirar ou registrar solicitações e implementar recursos 
de cancelamento de operações.
Exemplo: [command.php](command.php).

### Adapter

Converte a interface de um classe para outra interface que o cliente espera econtrar.
O adaptador permite que classes com interfaces incompatíveis trabalhem juntas.
Exemplo: [adapter.php](adapter.php).

### Facade

Fornece uma interface unificada para um conjunto de interfaces em um subsistema.
A fachada define uma interface de nível mais alto que facilida a utilização
do subsistema.
Exemplo: [facade.php](facade.php).

### Template Method

Define o esqueleto de um algoritimo dentro de um método, transferindo alguns de seus
passos para as subclasses. O template method permite que as subclasses redefinam certos
passos de algoritimo sem alterar a estrutura do própro algoritimo.
Exemplo: [template.php](template.php).

### Iterator

O Padrão Iterator fornece uma maneira de acessar sequencialmente os elementos de um objeto agregado
sem expor a sua representação subjacente.
Exemplo: [iterator.php](iterator.php)