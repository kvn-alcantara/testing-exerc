## Apostila - Treinamento de Testes Automatizados

### Exercicio:
Exercício 4 - Cálculo de Frete
Em todos os e-commerces, o usuário pode criar um carrinho de compras, adicionar um produto e calcular o valor do frete para a entrega.
O valor do frete é calculado a partir do CEP do usuário (destinatário), e geralmente é provido pelos serviços de fretamento (correios ou particular), muitas vezes sendo invocado uma API que, dado o CEP (dentre outros dados), traz o valor do frete.

### Definition of Done
Todos os requisitos devem estar cobertos por testes automatizados.
Deve existir pelo menos uma classe de testes para o serviço, e esse deverá cobrir todas as variações das regras do serviço. Além do mais, a comunicação com o serviço do correio deverá ser através de mocks.

### Requisitos:
- Composer
- PHP 8.1

### Rodando os testes:
```sh
composer test
```
