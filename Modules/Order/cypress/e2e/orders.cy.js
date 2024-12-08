describe('Orders tests', () => {
    beforeEach(() => {
        cy.intercept('GET', '/orders', {
            orders: [{
                id: 1,
                status: "prepared",
                meals_names: "cheese, tomato",
            }],
            statuses: ['new', 'prepared', 'cooked', 'ready'],
        })
            .visit('/');
    })

  it('displays correct heading text', () => {
    cy
        .get('h1')
        .should('have.text', 'Pizza POS');
  })

    it('makes request to orders index and displays them on page', () => {
        cy
            .getDataTest('order_name')
            .should('have.text', 'Order #1')

        cy.getDataTest('meals_names')
            .should('have.text', 'cheese, tomato')
    })

    it('displays solid check for order status and those behind, a loader for to next status and regular check for front statuses', () => {
        // new (behind order's prepared status)
        cy
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
        cy
            .getDataTest('order_1_cooked_loader')
            .should('exist')
            .should('be.visible');

        cy.getDataTest('order_1_cooked_check')
            .should('not.exist');

        // ready (front status)
        cy
            .getDataTest('order_1_ready_loader')
            .should('not.exist');

        cy.getDataTest('order_1_ready_check')
            .should('exist')
            .should('have.class', 'fa-regular')
            .should('not.have.class', 'fa-solid');
    })

    it('adds text-blue-900 class to order status elements and those behind, text-gray-200 for to next and front statuses', () => {
        // new (behind order's prepared status)
        cy
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
        cy
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

    it('displays expected button icon and text which belongs to next status', () => {
        cy
            .getDataTest('order_1_button')
            .contains('cooked')
            .getDataTest('order_1_button_icon')
            .should('have.class', 'fa-fire-burner');
    })

    it('does not display button for ready status', () => {
        cy.intercept('GET', '/orders', {
                orders: [{
                    id: 1,
                    status: "ready",
                    meals_names: "cheese, tomato",
                }],
                statuses: ['new', 'prepared', 'cooked', 'ready'],
            })
            .visit('/')
            .getDataTest('order_1_button')
            .should('not.exist');
    })

    it.only('updates displayed order elements after updating order status', () => {
        cy.intercept('PUT', '/orders/1', {
            order: {
                id: 1,
                status: "cooked",
                meals_names: "cheese, tomato",
            },
        });

        cy.getDataTest('order_1_button').click();

        cy.getDataTest('order_1_cooked_loader')
            .should('not.exist');

        cy.getDataTest('order_1_cooked_check')
            .should('exist')
            .should('have.class', 'fa-solid')
            .should('not.have.class', 'fa-regular');
    })
})
