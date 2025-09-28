module mult_control (
    input wire clk,
    input wire reset,
    output reg Asel,
    output reg Bsel,
    output reg Mle
);

    reg [1:0] state;

    parameter S0 = 2'b00; // Initial
    parameter S1 = 2'b01; // Load A
    parameter S2 = 2'b10; // Load B
    parameter S3 = 2'b11; // Perform multiplication

    always @(posedge clk or posedge reset) begin
        if (reset)
            state <= S0;
        else begin
            case (state)
                S0: state <= S1;
                S1: state <= S2;
                S2: state <= S3;
                S3: state <= S3;
                default: state <= S0;
            endcase
        end
    end

    always @(*) begin
        Asel = 0;
        Bsel = 0;
        Mle  = 0;

        case (state)
            S1: Asel = 1;
            S2: Bsel = 1;
            S3: Mle  = 1;
        endcase
    end

endmodule

module mult_datapath (
    input wire clk,
    input wire reset,
    input wire [3:0] A_input,
    input wire [3:0] B_input,
    input wire Asel,
    input wire Bsel,
    input wire Mle,
    output reg [7:0] result
);

    reg [3:0] A_reg;
    reg [3:0] B_reg;
    reg [7:0] product;

    always @(posedge clk or posedge reset) begin
        if (reset) begin
            A_reg <= 0;
            B_reg <= 0;
            product <= 0;
            result <= 0;
        end else begin
            if (Asel) begin
                A_reg <= A_input;
            end
            if (Bsel) begin
                B_reg <= B_input;
                product <= 0;
            end else if (Mle && B_reg > 0) begin
                product <= product + A_reg;
                B_reg <= B_reg - 1;
            end

            result <= product;
        end
    end

endmodule

module mult_top (
    input wire clk,
    input wire reset,
    input wire [3:0] A_input,
    input wire [3:0] B_input,
    output wire [7:0] result
);

    wire Asel, Bsel, Mle;

    mult_control control (
        .clk(clk),
        .reset(reset),
        .Asel(Asel),
        .Bsel(Bsel),
        .Mle(Mle)
    );

    mult_datapath datapath (
        .clk(clk),
        .reset(reset),
        .A_input(A_input),
        .B_input(B_input),
        .Asel(Asel),
        .Bsel(Bsel),
        .Mle(Mle),
        .result(result)
    );

endmodule

