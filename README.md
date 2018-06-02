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

## Design Patterns

### Strategy

Define uma famíla de algorítimos, encapsula cada um deles e os torna intercambiáveis.
A estratégia deixa o algorítimo variar independentemente dos clientes que o utilizam.

### Observer

Define a dependência UM para MUITOS entre objetos para que quando um objeto mude de estado
todos os seus dependentes sejam avisados e atualizados automaticamente.

### Decorator

Anexa responsabilidades adicionais a um objeto dinamicamente. Os decoradores fornecem
uma alternativa flexivel de subclasse para extender a funcionalidade.

### Factory Method

O padrão factory mathod define uma interface para criar um objeto, mas permite as
classes decidir qual classe instanciar. O factory method permite a uma classe deferir
a instanciação para subclasses.

### Abstract Factory

Fornece uma interface para criar famílias de objetos relacionados ou dependentes sem
especificar suas classes concretas.

### Singleton

Garente que uma classe tenha apenas um instância e fornece um ponto global de acesso a ela.

### Command

Encapsula uma solicitação como um objeto, o que lhe permite parametrizar outros objetos 
com diferentes solicitações, enfileirar ou registrar solicitações e implementar recursos 
de cancelamento de operações.

### Adapter

Converte a interface de um classe para outra interface que o cliente espera econtrar.
O adaptador permite que classes com interfaces incompatíveis trabalhem juntas.

### Facade

Fornece uma interface unificada para um conjunto de interfaces em um subsistema.
A fachada define uma interface de nível mais alto que facilida a utilização
do subsistema.

### Template Method

Define o esqueleto de um algoritimo dentro de um método, transferindo alguns de seus
passos para as subclasses. O template method permite que as subclasses redefinam certos
passos de algoritimo sem alterar a estrutura do própro algoritimo.