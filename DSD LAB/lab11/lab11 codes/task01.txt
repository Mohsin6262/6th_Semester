module factorial_control (
    input wire clk,
    input wire reset,
    output reg Asel,
    output reg Ale
);

    reg [1:0] state;

    // State Encoding
    parameter S0 = 2'b00; // Initial state
    parameter S1 = 2'b01; // Load A_input into register
    parameter S2 = 2'b10; // Start/Continue factorial computation

    always @(posedge clk or posedge reset) begin
        if (reset)
            state <= S0;
        else begin
            case (state)
                S0: state <= S1;
                S1: state <= S2;
                S2: state <= S2; // Remain in compute state
                default: state <= S0;
            endcase
        end
    end

    // Output logic
    always @(*) begin
        // Default to 0
        Asel = 0;
        Ale  = 0;

        case (state)
            S1: Asel = 1; // Load A_input
            S2: Ale  = 1; // Start/Continue factorial calculation
        endcase
    end

endmodule


module factorial_datapath (
    input wire clk,
    input wire reset,
    input wire [3:0] A_input,
    input wire Asel,
    input wire Ale,
    output reg [7:0] result
);

    reg [3:0] A_reg;
    reg [3:0] counter;
    reg [7:0] factorial;

    always @(posedge clk or posedge reset) begin
        if (reset) begin
            A_reg <= 0;
            counter <= 0;
            factorial <= 1;
            result <= 0;
        end else begin
            if (Asel) begin
                A_reg <= A_input;
                counter <= A_input;
                factorial <= 1;
            end else if (Ale && counter > 0) begin
                factorial <= factorial * counter;
                counter <= counter - 1;
            end

            result <= factorial;
        end
    end

endmodule


module factorial_top (
    input clk,
    input reset,
    input [3:0] A_input,
    output [7:0] result
);

    wire Asel, Ale;

    factorial_control control (
        .clk(clk),
        .reset(reset),
        .Asel(Asel),
        .Ale(Ale)
    );

    factorial_datapath datapath (
        .clk(clk),
        .reset(reset),
        .A_input(A_input),
        .Asel(Asel),
        .Ale(Ale),
        .result(result)
    );

endmodule
