describe('Orders tests', () => {
    beforeEach(() => {
        cy.intercept('GET', 'http://localhost/orders', {
            orders: [{
                id: 1,
                status: "prepared",
                meals_names: "cheese, tomato",
            }],
            statuses: ['new', 'prepared', 'cooked', 'ready'],
        });
    })

  it('displays correct heading text', () => {
    cy.visit('/')
        .get('h1')
        .should('have.text', 'Pizza POS');
  })

    it('makes request to orders index and displays them on page', () => {
        cy.visit('/')
            .getDataTest('order_name')
            .should('have.text', 'Order #1')

        cy.getDataTest('meals_names')
            .should('have.text', 'cheese, tomato')
    })


    it('it displays solid check for order status and those behind, a loader for to next status and regular check for front statuses', () => {
        // new (behind order's prepared status)
        cy.visit('/')
            .getDataTest('order_1_new_loader')
            .should('not.exist');

        cy.getDataTest('order_1_new_check')
            .should('exist')
            .should('have.class', 'fa-solid')
            .should('not.have.class', 'fa-regular');

        // prepared (order status)
        cy.getDataTest('order_1_prepared_loader')
            .should('not.exist');

        cy.getDataTest('order_1_prepared_check')
            .should('exist')
            .should('have.class', 'fa-solid')
            .should('not.have.class', 'fa-regular');

        // cooked (next status)
        cy.visit('/')
            .getDataTest('order_1_cooked_loader')
            .should('exist')
            .should('be.visible');

        cy.getDataTest('order_1_cooked_check')
            .should('not.exist');

        // ready (front status)
        cy.visit('/')
            .getDataTest('order_1_ready_loader')
            .should('not.exist');

        cy.getDataTest('order_1_ready_check')
            .should('exist')
            .should('have.class', 'fa-regular')
            .should('not.have.class', 'fa-solid');
    })

    it('it adds text-blue-900 class to order status elements and those behind, text-gray-200 for to next and front statuses', () => {
        // new (behind order's prepared status)
        cy.visit('/')
            .getDataTest('order_1_new_check')
            .should('have.class', 'text-blue-900')
            .should('not.have.class', 'text-gray-200')

            .getDataTest('order_1_new_status')
            .should('have.class', 'text-blue-900')
            .should('not.have.class', 'text-gray-200')

            .getDataTest('order_1_new_icon')
            .should('have.class', 'text-blue-900')
            .should('not.have.class', 'text-gray-200');

        // prepared (order status)
        cy.getDataTest('order_1_prepared_check')
            .should('have.class', 'text-blue-900')
            .should('not.have.class', 'text-gray-200')

            .getDataTest('order_1_prepared_status')
            .should('have.class', 'text-blue-900')
            .should('not.have.class', 'text-gray-200')

            .getDataTest('order_1_prepared_icon')
            .should('have.class', 'text-blue-900')
            .should('not.have.class', 'text-gray-200');

        // cooked (next status)
        cy.visit('/')
            .getDataTest('order_1_cooked_status')
            .should('have.class', 'text-gray-200')
            .should('not.have.class', 'text-blue-900')

            .getDataTest('order_1_cooked_icon')
            .should('have.class', 'text-gray-200')
            .should('not.have.class', 'text-blue-900');

        // prepared (order status)
        cy.getDataTest('order_1_ready_check')
            .should('have.class', 'text-gray-200')
            .should('not.have.class', 'text-blue-900')

            .getDataTest('order_1_ready_status')
            .should('have.class', 'text-gray-200')
            .should('not.have.class', 'text-blue-900')

            .getDataTest('order_1_ready_icon')
            .should('have.class', 'text-gray-200')
            .should('not.have.class', 'text-blue-900');
    })
})
