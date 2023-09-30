Escopo para finalizar o terminal:

Precisa verificar como vai ser o setup do terminal, mas provavelmente um post request com os dados do evento, autorizações e tambem um reset nos dados atuais

Precisa fazer o sync de dados com o servidor, então são as seguintes chamadas:
- Informar atividade e solicitar setup para o servidor
- Enviar os acessos conforme occorrem (fazer uma fila talvez, e dar status de sync)
- Receber os acessos globais (não sei se fila seria o ideal também, mas acho que pelo menos um status por terminal)
